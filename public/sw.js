// Service Worker for TENGELO PWA
const CACHE_NAME = 'tengelo-v1.0.0';
const STATIC_CACHE = 'tengelo-static-v1.0.0';
const DYNAMIC_CACHE = 'tengelo-dynamic-v1.0.0';

// Files to cache
const STATIC_ASSETS = [
  '/',
  '/css/app.css',
  '/js/app.js',
  '/manifest.json',
  '/images/icon-192.png',
  '/images/icon-512.png',
  '/favicon.ico',
  'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'
];

// Install event - cache static assets
self.addEventListener('install', event => {
  console.log('Service Worker installing.');
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then(cache => {
        console.log('Caching static assets');
        return cache.addAll(STATIC_ASSETS);
      })
      .catch(error => {
        console.error('Failed to cache static assets:', error);
      })
  );
  self.skipWaiting();
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
  console.log('Service Worker activating.');
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== STATIC_CACHE && cacheName !== DYNAMIC_CACHE) {
            console.log('Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  self.clients.claim();
});

// Fetch event - serve cached content when offline
self.addEventListener('fetch', event => {
  const { request } = event;

  // Handle API calls differently
  if (request.url.includes('/api/') || request.url.includes('/storage/')) {
    event.respondWith(
      fetch(request)
        .catch(() => {
          // Return offline response for API calls
          return new Response(JSON.stringify({
            error: 'offline',
            message: 'You are currently offline. Please check your internet connection and try again.'
          }), {
            headers: { 'Content-Type': 'application/json' }
          });
        })
    );
    return;
  }

  // Handle static assets and pages
  event.respondWith(
    caches.match(request)
      .then(cachedResponse => {
        if (cachedResponse) {
          return cachedResponse;
        }

        return fetch(request)
          .then(response => {
            // Don't cache non-successful responses or non-GET requests
            if (!response.ok || request.method !== 'GET') {
              return response;
            }

            // Clone the response for caching
            const responseClone = response.clone();

            caches.open(DYNAMIC_CACHE)
              .then(cache => {
                cache.put(request, responseClone);
              })
              .catch(error => {
                console.error('Failed to cache dynamic content:', error);
              });

            return response;
          })
          .catch(() => {
            // If both cache and network fail, show offline page
            if (request.headers.get('accept').includes('text/html')) {
              return caches.match('/')
                .then(cachedResponse => {
                  if (cachedResponse) {
                    return cachedResponse;
                  }
                  // Basic offline fallback HTML
                  const offlineHtml = `
                    <!DOCTYPE html>
                    <html>
                    <head>
                      <title>TENGELO - Offline</title>
                      <meta charset="utf-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1">
                      <style>
                        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f4f6f9; }
                        .offline-message { max-width: 500px; margin: 0 auto; padding: 30px; background: white; border-radius: 15px; box-shadow: 0 5px 25px rgba(0,0,0,0.1); }
                        h1 { color: #2d6a4f; margin-bottom: 20px; }
                        p { color: #6c757d; font-size: 16px; line-height: 1.6; }
                        .retry-btn { background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%); color: white; border: none; padding: 12px 25px; border-radius: 25px; cursor: pointer; font-weight: 600; margin-top: 20px; }
                      </style>
                    </head>
                    <body>
                      <div class="offline-message">
                        <i class="fas fa-wifi-slash" style="font-size: 48px; color: #ff8533; margin-bottom: 20px;"></i>
                        <h1>You're Offline</h1>
                        <p>TENGELO requires an internet connection to function properly. Please check your connection and try again.</p>
                        <button class="retry-btn" onclick="window.location.reload()">Try Again</button>
                      </div>
                    </body>
                    </html>
                  `;
                  return new Response(offlineHtml, {
                    headers: { 'Content-Type': 'text/html' }
                  });
                });
            }
          });
      })
  );
});

// Background sync for offline transactions
self.addEventListener('sync', event => {
  if (event.tag === 'background-sync-transactions') {
    event.waitUntil(syncPendingTransactions());
  }
});

async function syncPendingTransactions() {
  console.log('Syncing pending transactions...');
  try {
    // Get pending transactions from IndexedDB or cache
    const pendingTx = await getPendingTransactionsFromIDB();

    if (pendingTx && pendingTx.length > 0) {
      // Send transactions to server
      const promises = pendingTx.map(tx =>
        fetch('/api/transactions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(tx.data)
        })
      );

      const results = await Promise.allSettled(promises);

      // Remove successful transactions from IDB
      results.forEach((result, index) => {
        if (result.status === 'fulfilled') {
          removePendingTransaction(pendingTx[index].id);
        }
      });

      // Notify user of sync completion
      self.clients.matchAll().then(clients => {
        clients.forEach(client => {
          client.postMessage({
            type: 'SYNC_COMPLETE',
            syncedCount: results.filter(r => r.status === 'fulfilled').length,
            totalCount: pendingTx.length
          });
        });
      });
    }
  } catch (error) {
    console.error('Background sync failed:', error);
  }
}

// IndexedDB helpers (simplified for demo)
async function getPendingTransactionsFromIDB() {
  return new Promise((resolve) => {
    const request = indexedDB.open('tigula-offline-db', 1);

    request.onsuccess = (event) => {
      const db = event.target.result;
      const transaction = db.transaction(['pending-transactions'], 'readonly');
      const store = transaction.objectStore('pending-transactions');
      const getAll = store.getAll();

      getAll.onsuccess = () => {
        resolve(getAll.result || []);
      };
    };

    request.onerror = () => resolve([]);
  });
}

async function removePendingTransaction(id) {
  return new Promise((resolve) => {
    const request = indexedDB.open('tigula-offline-db', 1);

    request.onsuccess = (event) => {
      const db = event.target.result;
      const transaction = db.transaction(['pending-transactions'], 'readwrite');
      const store = transaction.objectStore('pending-transactions');
      store.delete(id);

      transaction.oncomplete = () => resolve();
    };

    request.onerror = () => resolve();
  });
}
