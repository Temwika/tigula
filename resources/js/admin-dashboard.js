// TENGELO Admin Dashboard Charts
document.addEventListener('DOMContentLoaded', function() {
    // Fetch chart data from API
    fetch('/api/chart-data/admin', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        initializeCharts(data);
    })
    .catch(error => {
        console.log('Using fallback data due to:', error);
        // Fallback data if API fails
        const fallbackData = {
            transactionTrends: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                data: [12, 19, 3, 5, 2, 3]
            },
            paymentStats: [65, 25, 10]
        };
        initializeCharts(fallbackData);
    });

    function initializeCharts(chartData) {
        // Initialize Transaction Trend Chart
        const transactionCtx = document.getElementById('transactionChart');
        if (transactionCtx) {
            const transactionChart = new Chart(transactionCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: chartData.transactionTrends.labels,
                    datasets: [{
                        label: 'Transactions',
                        data: chartData.transactionTrends.data,
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
                        data: chartData.paymentStats,
                        backgroundColor: ['#228B22', '#FFD700', '#FF4444']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    }
});