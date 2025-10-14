@extends('layouts.app')

@section('title', 'TIGULA - Digital Grain Payments')

@section('content')
<!-- Navigation -->
<nav class="bg-white shadow-sm border-b">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-seedling text-white text-sm"></i>
                </div>
                <span class="font-bold text-xl text-green-700">TIGULA</span>
            </div>

            <div class="flex items-center space-x-6">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition">
                        Get Started
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition">
                        Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="bg-gradient-to-br from-green-50 to-blue-50">
    <div class="max-w-6xl mx-auto px-4 py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Left Column -->
            <div>
                <div class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full mb-6">
                    <i class="fas fa-check-circle mr-2"></i>
                    Trusted by 15,000+ Farmers
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Digital Grain Payments
                    <span class="block text-green-600">Made Simple</span>
                </h1>

                <p class="text-lg text-gray-600 mb-8">
                    Pay farmers instantly via mobile money, eliminate cash handling risks, and track all transactions in real-time.
                </p>

                @guest
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-700 transition text-center">
                            Start Free Trial
                        </a>
                        <a href="#how" class="border border-gray-300 text-gray-700 px-8 py-3 rounded-full font-semibold hover:border-green-500 hover:text-green-600 transition text-center">
                            How It Works
                        </a>
                    </div>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-700 transition">
                        Go to Dashboard
                    </a>
                @endguest

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mt-12">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">15K+</div>
                        <div class="text-gray-600 text-sm">Farmers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">ZMW 75M</div>
                        <div class="text-gray-600 text-sm">Paid Out</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">500+</div>
                        <div class="text-gray-600 text-sm">Dealers</div>
                    </div>
                </div>
            </div>

            <!-- Right Column - App Preview -->
            <div class="flex justify-center">
                <div class="relative">
                    <div class="bg-black rounded-3xl p-3 shadow-2xl">
                        <div class="bg-gradient-to-br from-green-400 to-blue-500 rounded-2xl p-4 text-white">
                            <!-- App Header -->
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-seedling"></i>
                                    <span class="font-bold">TIGULA</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                    <span class="text-xs">LIVE</span>
                                </div>
                            </div>

                            <!-- Dashboard -->
                            <div class="bg-white/10 backdrop-blur rounded-xl p-4 mb-4">
                                <h3 class="font-semibold mb-3">Today's Payments</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <div class="text-lg font-bold">ZMW 45K</div>
                                        <div class="text-xs opacity-75">Paid Today</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold">230</div>
                                        <div class="text-xs opacity-75">Farmers</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Transaction -->
                            <div class="bg-white/10 backdrop-blur rounded-xl p-4">
                                <h4 class="font-semibold mb-3">Recent Transaction</h4>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium">Chileshe Mwale</div>
                                        <div class="text-xs opacity-75">Maize • 45kg</div>
                                    </div>
                                    <div class="text-green-400 font-bold">-ZMW 1,125</div>
                                </div>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-around mt-6">
                                <div class="text-center">
                                    <i class="fas fa-home text-green-400 mb-1"></i>
                                    <div class="text-xs">Home</div>
                                </div>
                                <div class="text-center opacity-50">
                                    <i class="fas fa-plus-circle mb-1"></i>
                                    <div class="text-xs">Pay</div>
                                </div>
                                <div class="text-center opacity-50">
                                    <i class="fas fa-history mb-1"></i>
                                    <div class="text-xs">History</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-shield text-sm"></i>
                    </div>
                    <div class="absolute top-8 -left-4 w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-mobile-alt text-xs"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- How It Works -->
<section id="how" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">How TIGULA Works</h2>
            <p class="text-gray-600">Three simple steps to start paying farmers digitally</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">
                    1
                </div>
                <h3 class="text-xl font-semibold mb-3">Register</h3>
                <p class="text-gray-600">Create dealer account and add farmer details with NRC verification</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">
                    2
                </div>
                <h3 class="text-xl font-semibold mb-3">Record</h3>
                <p class="text-gray-600">Enter grain transaction details including weight and quality</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">
                    3
                </div>
                <h3 class="text-xl font-semibold mb-3">Pay</h3>
                <p class="text-gray-600">Farmers receive instant payment via mobile money</p>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose TIGULA?</h2>
            <p class="text-gray-600">Built specifically for Zambia's agriculture sector</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-mobile-alt text-green-600"></i>
                </div>
                <h3 class="font-semibold mb-2">Mobile Money</h3>
                <p class="text-gray-600 text-sm">Instant payments via Airtel Money, MTN Money, and Zamtel</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-green-600"></i>
                </div>
                <h3 class="font-semibold mb-2">Zero Risk</h3>
                <p class="text-gray-600 text-sm">Digital transactions eliminate cash handling and theft risks</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-green-600"></i>
                </div>
                <h3 class="font-semibold mb-2">Real-Time Tracking</h3>
                <p class="text-gray-600 text-sm">Monitor all transactions and payments in real-time</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-clock text-green-600"></i>
                </div>
                <h3 class="font-semibold mb-2">24/7 Access</h3>
                <p class="text-gray-600 text-sm">Manage payments anytime from web or mobile</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-users text-green-600"></i>
                </div>
                <h3 class="font-semibold mb-2">Farmer Database</h3>
                <p class="text-gray-600 text-sm">Complete farmer management with payment history</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <h3 class="font-semibold mb-2">SMS Confirmations</h3>
                <p class="text-gray-600 text-sm">Instant SMS notifications for all payments</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Simple Pricing</h2>
            <p class="text-gray-600">Start free, pay only when you scale</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="border border-gray-200 rounded-xl p-8 text-center">
                <h3 class="text-xl font-semibold mb-2">Trial</h3>
                <div class="text-3xl font-bold text-green-600 mb-4">FREE</div>
                <p class="text-gray-600 mb-6">Try for 30 days</p>
                <ul class="text-sm text-gray-600 text-left space-y-2 mb-8">
                    <li>✓ Up to 100 transactions</li>
                    <li>✓ Mobile money payments</li>
                    <li>✓ Basic reporting</li>
                </ul>
                <a href="{{ route('register') }}" class="block bg-gray-100 text-gray-700 px-6 py-3 rounded-full hover:bg-gray-200 transition">
                    Start Trial
                </a>
            </div>

            <div class="border-2 border-green-500 bg-green-50 rounded-xl p-8 text-center relative">
                <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-1 rounded-full text-sm">
                    Popular
                </div>
                <h3 class="text-xl font-semibold mb-2">Professional</h3>
                <div class="text-3xl font-bold text-green-600 mb-4">ZMW 299</div>
                <p class="text-gray-600 mb-6">Per month</p>
                <ul class="text-sm text-gray-600 text-left space-y-2 mb-8">
                    <li>✓ Unlimited transactions</li>
                    <li>✓ All mobile money providers</li>
                    <li>✓ Advanced analytics</li>
                    <li>✓ API access</li>
                </ul>
                <a href="{{ route('register') }}" class="block bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition">
                    Choose Plan
                </a>
            </div>

            <div class="border border-gray-200 rounded-xl p-8 text-center">
                <h3 class="text-xl font-semibold mb-2">Enterprise</h3>
                <div class="text-3xl font-bold text-green-600 mb-4">Custom</div>
                <p class="text-gray-600 mb-6">For large operations</p>
                <ul class="text-sm text-gray-600 text-left space-y-2 mb-8">
                    <li>✓ Custom integrations</li>
                    <li>✓ White-label solution</li>
                    <li>✓ Dedicated support</li>
                    <li>✓ On-premise deployment</li>
                </ul>
                <a href="mailto:enterprise@tigula.co.zm" class="block bg-gray-100 text-gray-700 px-6 py-3 rounded-full hover:bg-gray-200 transition">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<div class="bg-green-600 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center text-white">
        <h2 class="text-3xl font-bold mb-6">Ready to Modernize Your Grain Payments?</h2>
        <p class="text-lg mb-8 text-green-100">
            Join hundreds of agro-dealers who have eliminated cash risks and streamlined farmer payments.
        </p>
        @guest
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-green-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition">
                    Start Free Trial
                </a>
                <a href="#how" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-green-600 transition">
                    Learn More
                </a>
            </div>
        @else
            <a href="{{ route('dashboard') }}" class="bg-white text-green-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition">
                Go to Dashboard
            </a>
        @endguest
    </div>
</div>

        <!-- Footer -->
        <footer class="bg-green-600 py-8 mt-16">
            <div class="max-w-4xl mx-auto px-4 text-center text-white">
                <p class="text-green-100">© 2025 TIGULA - Digital Grain Payments Platform</p>
            </div>
        </footer>

@endsection

@push('styles')
<style>
    .trust-badge {
        animation: pulse 2s infinite;
    }

    .app-preview {
        filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.15));
    }

    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@endsection

@push('styles')
<style>
/* Modern TIGULA Landing Page Styles */
.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

/* Improved phone styles */
.phone-mockup {
    position: relative;
}

.phone-frame {
    border-radius: 3rem;
    padding: 8px;
}

.phone-screen {
    border-radius: 2.5rem;
    overflow: hidden;
}

/* App styles */
.app-navigation button.active {
    background: rgba(0, 0, 0, 0.1);
    color: #10b981;
}

/* Floating indicators */
.trust-indicators {
    position: absolute;
    top: -20px;
    left: -20px;
}

.indicator {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    animation: float 3s ease-in-out infinite;
}

.indicator.shield { background: linear-gradient(135deg, #10b981, #059669); }
.indicator.zap { background: linear-gradient(135deg, #f59e0b, #d97706); animation-delay: 1s; }
.indicator.award { background: linear-gradient(135deg, #3b82f6, #2563eb); animation-delay: 2s; }

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .app-showcase {
        transform: scale(0.8);
    }

    .hero-title {
        font-size: 2.5rem;
    }
}
</style>
@endpush
