@extends('layouts.app', ['activeMenu' => 'dashboard'])

@section('title', 'Dashboard - Tigula')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">
                <i class="fas fa-chart-line me-3"></i>Welcome to Tigula Dashboard
            </h1>
            <p class="text-muted">Monitor your grain trading operations, view market insights, and manage payments securely.</p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('status'))
        <div class="alert alert-modern alert-success animate-fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-modern alert-success animate-fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-modern alert-danger animate-fade-in" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Statistics Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Today's Transactions</h6>
                            <h3 class="stats-number">{{ $stats['total_transactions_today'] ?? 0 }}</h3>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 75%"></div>
                    </div>
                    <small class="text-muted">+12% from yesterday</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div>
                        <div>
                            <h6 class="text-muted mb-1">Total Paid Today</h6>
                            <h3 class="stats-number text-success">ZMW {{ number_format($stats['total_amount_today'] ?? 0, 2) }}</h3>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-money-bill-wave text-success"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                    <small class="text-muted">+8% from yesterday</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div>
                        <div>
                            <h6 class="text-muted mb-1">Active Buyers</h6>
                            <h3 class="stats-number">{{ $stats['active_buyers'] ?? 0 }}</h3>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-users text-warning"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 65%"></div>
                    </div>
                    <small class="text-muted">3 new today</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div>
                        <div>
                            <h6 class="text-muted mb-1">Farmers Served</h6>
                            <h3 class="stats-number">{{ $stats['farmers_served_today'] ?? 0 }}</h3>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-user-friends text-info"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: 80%"></div>
                    </div>
                    <small class="text-muted">Ready for payments</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <a href="{{ route('transactions.quick-create') }}" class="action-card">
                                <div class="action-card-content">
                                    <div class="action-icon">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6>Quick Purchase</h6>
                                    <p>Create new grain transaction</p>
                                </div>
                            </a>
                        </div>

                        @if(auth()->user()->isAdmin())
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <a href="{{ route('payments.pending') }}" class="action-card">
                                <div class="action-card-content">
                                    <div class="action-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <h6>Approve Payments</h6>
                                    <p>Review pending payments</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <a href="{{ route('farmers.create') }}" class="action-card">
                                <div class="action-card-content">
                                    <div class="action-icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <h6>Add Farmer</h6>
                                    <p>Register new farmer</p>
                                </div>
                            </a>
                        </div>
                        @endif

                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <a href="{{ route('transactions.index') }}" class="action-card">
                                <div class="action-card-content">
                                    <div class="action-icon">
                                        <i class="fas fa-list"></i>
                                    </div>
                                    <h6>View Transactions</h6>
                                    <p>All transaction history</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <a href="{{ route('farmers.index') }}" class="action-card">
                                <div class="action-card-content">
                                    <div class="action-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h6>Manage Farmers</h6>
                                    <p>All registered farmers</p>
                                </div>
                            </a>
                        </div>

                        @if(auth()->user()->isAdmin())
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <a href="#" class="action-card">
                                <div class="action-card-content">
                                    <div class="action-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <h6>Analytics</h6>
                                    <p>View detailed reports</p>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                    <div class="flex items-center text-white">
                        <span class="text-2xl mr-3">💰</span>
                        <div>
                            <h3 class="font-bold text-lg">Send Float to Buyers</h3>
                            <p class="text-green-100 text-sm">Allocate digital money safely</p>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-600 mb-4">Send digital float to your field buyers to purchase grain without cash risks.</p>
                    <div class="space-y-2">
                        <a href="{{ route('transactions.quick-create') }}" class="block w-full text-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                            Quick Purchase
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('payments.pending') }}" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                                💳 Approve Payments
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
                    <div class="flex items-center text-white">
                        <span class="text-2xl mr-3">�</span>
                        <div>
                            <h3 class="font-bold text-lg">Mobile Money Payments</h3>
                            <p class="text-orange-100 text-sm">Instant farmer payments</p>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-600 mb-4">Pay farmers instantly via Airtel Money, MTN Money, or Zamtel mobile money.</p>
                    <a href="{{ route('farmers.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 inline-block">
                        View Farmers
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                    <div class="flex items-center text-white">
                        <span class="text-2xl mr-3">�</span>
                        <div>
                            <h3 class="font-bold text-lg">Transaction Security</h3>
                            <p class="text-blue-100 text-sm">Full audit trail & tracking</p>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-600 mb-4">Track all field purchases with complete digital records and mobile money receipts.</p>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        View Reports
                    </button>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin() && isset($todaysBuyerActivity))
        <!-- Today's Buyer Activity -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <span class="text-2xl mr-3">📈</span>
                    Today's Buyer Activity
                </h2>
                <div class="text-sm text-gray-500">
                    Real-time purchase tracking
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($todaysBuyerActivity as $buyer)
                <div class="border border-gray-200 rounded-lg p-4 hover:border-green-300 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $buyer->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $buyer->phone ?? 'No phone' }}</p>
                        </div>
                        <div class="text-right">
                            @if($buyer->todays_transactions > 0)
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            @else
                                <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Purchases:</span>
                            <span class="font-semibold">{{ $buyer->todays_transactions }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total Amount:</span>
                            <span class="font-semibold text-green-600">
                                K{{ number_format($buyer->todays_total ?? 0, 0) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Status:</span>
                            @if($buyer->todays_transactions > 0)
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Active</span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Inactive</span>
                            @endif
                        </div>
                    </div>
                    
                    @if(auth()->user()->isAdmin() && $buyer->todays_transactions > 0)
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <button type="button" 
                                onclick="transferFloat('{{ $buyer->id }}', '{{ $buyer->name }}')"
                                class="w-full text-xs bg-blue-50 hover:bg-blue-100 text-blue-600 py-2 px-3 rounded transition-colors">
                            💸 Send More Float
                        </button>
                    </div>
                    @endif
                </div>
                @empty
                <div class="col-span-3 text-center py-8 text-gray-500">
                    <span class="text-4xl mb-2 block">🏪</span>
                    No buyer activity today yet
                </div>
                @endforelse
            </div>
        </div>
        @endif

        <!-- Market Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Grain Types & Prices -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">🌾</span>
                    Today's Grain Prices
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-yellow-400 rounded-full mr-3"></span>
                            <div>
                                <div class="font-semibold">Maize</div>
                                <div class="text-sm text-gray-500">Per 25kg bag</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-green-600">K 185.00</div>
                            <div class="text-sm text-green-500">+2.5%</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-orange-400 rounded-full mr-3"></span>
                            <div>
                                <div class="font-semibold">Soybeans</div>
                                <div class="text-sm text-gray-500">Per 25kg bag</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-green-600">K 420.00</div>
                            <div class="text-sm text-green-500">+1.8%</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-brown-400 rounded-full mr-3"></span>
                            <div>
                                <div class="font-semibold">Groundnuts</div>
                                <div class="text-sm text-gray-500">Per 25kg bag</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-red-600">K 380.00</div>
                            <div class="text-sm text-red-500">-0.8%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">📈</span>
                    Recent Activity
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center p-4 bg-green-50 rounded-lg">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            ✓
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Transaction Completed</div>
                            <div class="text-sm text-gray-500">250 bags of maize sold to ABC Traders</div>
                        </div>
                        <div class="text-sm text-gray-400">2h ago</div>
                    </div>
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            💰
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Payment Received</div>
                            <div class="text-sm text-gray-500">K 46,250 via mobile money</div>
                        </div>
                        <div class="text-sm text-gray-400">5h ago</div>
                    </div>
                    <div class="flex items-center p-4 bg-orange-50 rounded-lg">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            📱
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">SMS Alert Sent</div>
                            <div class="text-sm text-gray-500">Price update for soybeans</div>
                        </div>
                        <div class="text-sm text-gray-400">1d ago</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">📊</div>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['total_transactions_today'] ?? 0 }}</div>
                <div class="text-gray-500">Purchases Today</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">💰</div>
                <div class="text-2xl font-bold text-green-600">K{{ number_format($stats['total_amount_today'] ?? 0, 0) }}</div>
                <div class="text-gray-500">Paid Out Today</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">👥</div>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['active_buyers'] ?? 0 }}</div>
                <div class="text-gray-500">Active Buyers</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">👨‍🌾</div>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['farmers_served_today'] ?? 0 }}</div>
                <div class="text-gray-500">Farmers Served Today</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">💰</div>
                <div class="text-2xl font-bold text-gray-800">K 2.8M</div>
                <div class="text-gray-500">Total Volume</div>
            </div>
        </div>

        <!-- About Tigula -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Tigula</h2>
                <div class="max-w-4xl mx-auto space-y-4">
                    <p class="text-lg text-gray-600">
                        <strong class="text-green-600">Tigula</strong> — the digital solution for agro-dealers and aggregators who want to eliminate 
                        the risk of sending field buyers with cash to purchase grain from rural farmers.
                    </p>
                    <p class="text-gray-600">
                        In the rural villages of Sinda District, Eastern Province, agro-dealers face the dangerous reality of sending buyers into the field with large amounts of cash. 
                        Tigula, an innovation by <strong>Uplift Services Limited</strong>, eliminates this risk through <strong class="text-orange-600">digital money floats and instant mobile money payments</strong>.
                    </p>
                    <p class="text-gray-600">
                        Instead of cash, your field buyers receive <strong class="text-orange-600">digital float allocations</strong> on the Tigula platform. 
                        When they purchase grain from farmers in Mkaika, Nyimba, Kakoma, or Chikumbi, payments are instantly sent to farmers' phones via 
                        <strong>Airtel Money, MTN Money, or Zamtel mobile money</strong> — making transactions safer, faster, and fully trackable.
                    </p>
                    <p class="text-lg font-semibold text-gray-800 italic">
                        From cash-risk to cashless-success — Tigula makes grain buying safer for agro-dealers and more convenient for farmers.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🔒</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Zero Cash Risk</h3>
                    <p class="text-gray-600">Eliminate the danger of sending field buyers with cash. Digital floats keep your money secure until transactions are completed.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📱</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Mobile Money Integration</h3>
                    <p class="text-gray-600">Instant payments to farmers via Airtel Money, MTN Money, and Zamtel — no more cash handling or security concerns.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🌍</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Rural Empowerment</h3>
                    <p class="text-gray-600">Empowering small-scale farmers in Eastern Province by connecting rural producers directly to local and regional markets.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function transferFloat(buyerId, buyerName) {
    const amount = prompt(`How much float do you want to send to ${buyerName}?`, '1000');
    if (amount && !isNaN(amount) && parseFloat(amount) > 0) {
        // TODO: Implement actual float transfer
        alert(`Sending K${amount} float to ${buyerName}. This feature will be implemented with backend integration.`);
        console.log(`Transfer K${amount} to buyer ${buyerId}`);
    }
}
</script>

@endsection
