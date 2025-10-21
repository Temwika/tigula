// TENGELO Admin Dashboard Charts
document.addEventListener('DOMContentLoaded', function() {
    // Get chart data from data attributes
    const chartDataEl = document.getElementById('chart-data');
    if (!chartDataEl) return;
    
    const transactionLabels = JSON.parse(chartDataEl.getAttribute('data-transaction-labels')) || ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const transactionData = JSON.parse(chartDataEl.getAttribute('data-transaction-data')) || [12, 19, 3, 5, 2, 3];
    const paymentStats = JSON.parse(chartDataEl.getAttribute('data-payment-stats')) || [65, 25, 10];

    // Initialize Transaction Trend Chart
    const transactionCtx = document.getElementById('transactionChart');
    if (transactionCtx) {
        const transactionChart = new Chart(transactionCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: transactionLabels,
                datasets: [{
                    label: 'Transactions',
                    data: transactionData,
                    borderColor: '#FF8C00',
                    backgroundColor: 'rgba(255, 140, 0, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Initialize Payment Status Chart
    const paymentCtx = document.getElementById('paymentChart');
    if (paymentCtx) {
        const paymentChart = new Chart(paymentCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending', 'Failed'],
                datasets: [{
                    data: paymentStats,
                    backgroundColor: ['#228B22', '#FFD700', '#FF4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});