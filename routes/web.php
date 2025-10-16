<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;

// Root route - show landing page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Laravel authentication routes
Auth::routes(['login' => false]);

// Custom login routes for clean UI
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Home route - redirect to dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Farmer routes
    Route::resource('farmers', FarmerController::class);
    Route::get('/farmers/search/{nrc}', [FarmerController::class, 'search'])->name('farmers.search');

    // Transaction routes
    Route::resource('transactions', TransactionController::class);
    Route::get('/transactions/quick-create', [TransactionController::class, 'quickCreate'])->name('transactions.quick-create');
    Route::post('/transactions/quick-store', [TransactionController::class, 'quickStore'])->name('transactions.quick-store');
    Route::get('/transactions/pending/approvals', [TransactionController::class, 'pending'])->name('transactions.pending');
    Route::post('/transactions/{transaction}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');

    // Payment routes (Admin only)
    Route::middleware(['admin'])->group(function () {
        Route::resource('payments', PaymentController::class)->only(['index']);
        Route::get('/payments/pending', [PaymentController::class, 'pending'])->name('payments.pending');
        Route::post('/transactions/{transaction}/initiate-payment', [PaymentController::class, 'initiate'])->name('payments.initiate');
        Route::post('/payments/{payment}/complete', [PaymentController::class, 'complete'])->name('payments.complete');
        Route::post('/payments/{payment}/approve', [PaymentController::class, 'approve'])->name('payments.approve');
        Route::post('/payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');
    });

    // Audit Logs
    Route::resource('audit-logs', \App\Http\Controllers\AuditLogController::class)->only(['index']);
});

// SMS Debug and Test Routes (admin only)
Route::middleware(['auth'])->group(function () {
    Route::get('/debug-sms', function () {
        if (!auth()->check()) {
            abort(403);
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (!$user->isAdmin()) {
            abort(403);
        }

        $config = config('services.sms');
        $recentNotifications = App\Models\Notification::latest()->take(5)->get();

        return response()->json([
            'sms_config' => $config,
            'env_check' => [
                'SMS_ENABLED' => env('SMS_ENABLED'),
                'SMS_PROVIDER' => env('SMS_PROVIDER'),
                'SMS_GATEWAY_URL' => env('SMS_GATEWAY_URL'),
                'SMS_API_KEY' => env('SMS_API_KEY') ? 'Set' : 'Not Set',
            ],
            'recent_notifications' => $recentNotifications,
            'notification_count' => App\Models\Notification::count()
        ]);
    })->name('debug.sms');

    Route::get('/test-sms', function () {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        try {
            $notifier = new App\Services\NotificationService();

            // Create a reflection method to access protected sendSMS
            $reflection = new ReflectionClass($notifier);
            $method = $reflection->getMethod('sendSMS');
            $method->setAccessible(true);

            $testPhone = '+260971234567';
            $testMessage = 'Hello from Tigula! This is a test SMS to verify your SMS configuration is working. Time: ' . now()->format('H:i:s');

            $result = $method->invoke($notifier, $testPhone, $testMessage, null);

            // Get the latest notification
            $latestNotification = App\Models\Notification::latest()->first();

            return response()->json([
                'success' => $result,
                'message' => $result ? 'SMS processing completed' : 'SMS processing failed',
                'config' => [
                    'provider' => config('services.sms.provider'),
                    'enabled' => config('services.sms.enabled'),
                    'gateway_url' => config('services.sms.gateway_url')
                ],
                'test_details' => [
                    'phone' => $testPhone,
                    'message_length' => strlen($testMessage)
                ],
                'latest_notification' => $latestNotification,
                'total_notifications' => App\Models\Notification::count()
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    })->name('test.sms');

    Route::get('/test-twilio', function () {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Check if Twilio credentials are set
        $twilioConfig = config('services.sms.twilio');

        if (!$twilioConfig['sid'] || !$twilioConfig['token'] || !$twilioConfig['from']) {
            return response()->json([
                'success' => false,
                'message' => 'Twilio not configured. Please set TWILIO_SID, TWILIO_TOKEN, and TWILIO_FROM in .env',
                'config_needed' => [
                    'TWILIO_SID' => 'Your Twilio Account SID',
                    'TWILIO_TOKEN' => 'Your Twilio Auth Token',
                    'TWILIO_FROM' => 'Your Twilio phone number (e.g., +1234567890)'
                ]
            ]);
        }

        try {
            // Test Twilio SMS
            $notifier = new App\Services\NotificationService();
            $reflection = new ReflectionClass($notifier);
            $method = $reflection->getMethod('sendViaTwilio');
            $method->setAccessible(true);

            $testPhone = '+260971234567';
            $testMessage = 'Test SMS from Tigula via Twilio at ' . now()->format('H:i:s');

            $result = $method->invoke($notifier, $testPhone, $testMessage);

            return response()->json([
                'twilio_test' => $result,
                'config' => $twilioConfig,
                'test_phone' => $testPhone
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    })->name('test.twilio');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
