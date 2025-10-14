@extends('layouts.app')

@section('title', 'TIGULA - Modern African Agriculture Platform')

@section('content')
<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-seedling text-white text-lg"></i>
                </div>
                <div class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                    TIGULA
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-gray-600 hover:text-emerald-600 transition-colors font-medium">Features</a>
                <a href="#how" class="text-gray-600 hover:text-emerald-600 transition-colors font-medium">How It Works</a>
                <a href="#pricing" class="text-gray-600 hover:text-emerald-600 transition-colors font-medium">Pricing</a>
                <span class="text-teal-600 font-bold">TIGULA Platform</span>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-700 transition-all duration-200 transform hover:scale-105">
                        Get Started
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-700 transition-all duration-200">
                        Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative pt-20 pb-32 bg-gradient-to-br from-emerald-50 via-blue-50 to-green-50 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-green-50 opacity-80"></div>
    <div class="absolute top-20 right-20 w-72 h-72 bg-gradient-to-br from-emerald-200 to-green-200 rounded-full blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute bottom-20 left-20 w-64 h-64 bg-gradient-to-tr from-blue-200 to-emerald-200 rounded-full blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[80vh]">
            <!-- Left Content -->
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-800 text-sm rounded-full mb-6">
                    <i class="fas fa-seedling mr-2"></i>
                    Zambia's Grain Trading Platform
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Instant Farmer Payments
                    <span class="block text-emerald-600">Made Simple</span>
                </h1>

                <p class="text-lg text-gray-600 mb-8 max-w-lg">
                    Pay farmers instantly via mobile money, eliminate cash handling risks, and track every grain transaction in real-time across Zambia.
                </p>

                @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition text-center">
                            Start Free Trial
                        </a>
                        <a href="#features" class="border border-emerald-600 text-emerald-600 px-8 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition text-center">
                            Learn More
                        </a>
                    </div>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                        Go to Dashboard
                    </a>
                @endguest

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 mt-12">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600">15K+</div>
                        <div class="text-gray-600 text-sm">Farmers Paid</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600">ZMW 75M</div>
                        <div class="text-gray-600 text-sm">Processed</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600">500+</div>
                        <div class="text-gray-600 text-sm">Agro-Dealers</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Phone Mockup -->
            <div class="flex justify-center">
                <div class="relative">
                    <!-- Phone Frame -->
                    <div class="bg-gray-900 rounded-3xl p-4 shadow-2xl max-w-sm mx-auto">
                        <div class="bg-gradient-to-br from-emerald-100 to-green-100 rounded-2xl p-6 h-96 overflow-hidden">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-emerald-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-seedling text-white text-xs"></i>
                                    </div>
                                    <span class="font-bold text-emerald-800">TIGULA</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-xs text-emerald-800">LIVE</span>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <button class="bg-white/80 backdrop-blur-sm text-emerald-800 py-3 px-4 rounded-xl font-semibold shadow-sm">
                                    <i class="fas fa-plus mr-2"></i>Pay Farmer
                                </button>
                                <button class="bg-white/80 backdrop-blur-sm text-emerald-800 py-3 px-4 rounded-xl font-semibold shadow-sm">
                                    <i class="fas fa-book mr-2"></i>Receipts
                                </button>
                            </div>

                            <!-- Recent Payments -->
                            <div class="space-y-3">
                                <h4 class="text-sm font-semibold text-emerald-800 mb-3">Today's Payments</h4>

                                <div class="bg-white/60 backdrop-blur-sm rounded-lg p-3 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 text-sm">Chileshe Mwale</div>
                                            <div class="text-xs text-gray-600">Maize • 45kg</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-green-600 text-sm">ZMW 1,125</div>
                                        <div class="text-xs text-gray-500">2 mins ago</div>
                                    </div>
                                </div>

                                <div class="bg-white/60 backdrop-blur-sm rounded-lg p-3 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-user text-purple-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 text-sm">Blessings Banda</div>
                                            <div class="text-xs text-gray-600">Soybeans • 32kg</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-green-600 text-sm">ZMW 960</div>
                                        <div class="text-xs text-gray-500">15 mins ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-mobile-alt text-xs"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Features Section -->
<section id="features" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full mb-4">
                <i class="fas fa-certificate mr-2"></i>
                Enterprise-Grade Security
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Professional Payment Platform
                <span class="block text-blue-600">Trusted by Industry Leaders</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                TIGULA meets the highest standards of financial platform excellence with bank-level security,
                compliance certifications, and enterprise-grade reliability for business-critical operations.
            </p>
        </div>

        <!-- Enterprise Features Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-lock text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Bank-Grade Security</h3>
                <p class="text-gray-600">256-bit SSL encryption, PCI DSS compliant, and military-grade data protection ensuring your financial data is always secure.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Regulatory Compliant</h3>
                <p class="text-gray-600">Fully regulated by Bank of Zambia and compliant with all local financial regulations and international standards.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-chart-bar text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Advanced Analytics</h3>
                <p class="text-gray-600">Comprehensive reporting dashboards with real-time insights, transaction analytics, and automated financial reporting.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-cogs text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Enterprise Integration</h3>
                <p class="text-gray-600">RESTful API, webhook support, and seamless integration with existing enterprise systems and accounting software.</p>
            </div>
        </div>

        <!-- Audit & Compliance Section -->
        <div class="bg-white rounded-3xl p-12 shadow-lg border border-gray-100">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">
                        SOC 2 Type II Certified
                        <span class="block text-blue-600">Audit & Compliance Ready</span>
                    </h3>
                    <p class="text-lg text-gray-600 mb-8">
                        Our platform undergoes regular independent security audits and maintains the highest standards
                        of data protection, financial compliance, and operational excellence.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <span class="font-medium text-gray-900">ISO 27001 Certified</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-blue-600"></i>
                            </div>
                            <span class="font-medium text-gray-900">GDPR Compliant</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-purple-600"></i>
                            </div>
                            <span class="font-medium text-gray-900">SOC 2 Type II</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-indigo-600"></i>
                            </div>
                            <span class="font-medium text-gray-900">Bank of Zambia Approved</span>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
                        <div class="text-center mb-8">
                            <i class="fas fa-award text-6xl text-blue-600 mb-4"></i>
                            <h4 class="text-2xl font-bold text-gray-900 mb-2">Trust & Transparency</h4>
                            <p class="text-gray-600">Verified security standards and independent audits</p>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-900">Security Audits</span>
                                <span class="text-green-600 font-semibold">✓ Monthly</span>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-900">Compliance Review</span>
                                <span class="text-green-600 font-semibold">✓ Quarterly</span>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-900">Penetration Testing</span>
                                <span class="text-green-600 font-semibold">✓ Bi-annual</span>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <span class="font-medium text-gray-900">Incident Response</span>
                                <span class="text-green-600 font-semibold">✓ 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section id="how" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Enterprise Digital Workflow
                <span class="block text-blue-600">Built for Scale & Efficiency</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A streamlined, professional process designed for serious business operations with
                robust controls, audit trails, and enterprise-grade automation.
            </p>
        </div>

        <div class="relative">
            <!-- Process Line -->
            <div class="hidden lg:block absolute top-24 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-200 via-indigo-200 to-purple-200"></div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-8 text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform">
                        01
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 mb-4 group-hover:bg-white group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-user-shield text-3xl text-blue-600 mb-6"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Secure Onboarding</h3>
                        <p class="text-gray-600">Enterprise-grade KYC verification, multiple approval workflows, and compliance validation for all stakeholders.</p>
                    </div>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-8 text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform">
                        02
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 mb-4 group-hover:bg-white group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-file-contract text-3xl text-indigo-600 mb-6"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Contract Management</h3>
                        <p class="text-gray-600">Digital contract creation, e-signature capabilities, and automated approval workflows with full audit trails.</p>
                    </div>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-8 text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform">
                        03
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 mb-4 group-hover:bg-white group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-exchange-alt text-3xl text-purple-600 mb-6"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Transaction Processing</h3>
                        <p class="text-gray-600">Real-time payment processing with multi-level approvals, fraud detection, and instant settlement confirmation.</p>
                    </div>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                <!-- Step 4 -->
                <div class="relative text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-red-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-8 text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform">
                        04
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-8 mb-4 group-hover:bg-white group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-chart-line text-3xl text-pink-600 mb-6"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Analytics & Reporting</h3>
                        <p class="text-gray-600">Comprehensive dashboards, automated reporting, and business intelligence tools for data-driven decisions.</p>
                    </div>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-pink-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 text-sm font-semibold rounded-full mb-4">
                <i class="fas fa-calculator mr-2"></i>
                Flexible Enterprise Pricing
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Plans Built for
                <span class="block text-green-600">Professional Operations</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Choose the enterprise plan that matches your business scale with transparent pricing,
                no hidden fees, and dedicated enterprise support.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Starter Plan -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-seedling text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Professional</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">ZMW 499</div>
                    <div class="text-gray-600 mb-8">per month + transaction fees</div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Up to 1,000 transactions/month</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">All mobile money providers</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Real-time dashboard</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Email support</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Basic API access</span>
                        </div>
                    </div>

                    <a href="{{ route('register') }}" class="block w-full bg-blue-600 text-white py-4 rounded-xl font-semibold hover:bg-blue-700 transition-colors text-center">
                        Start Professional
                    </a>
                </div>
            </div>

            <!-- Growth Plan -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 shadow-lg border-2 border-blue-200 relative transform scale-105">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-full text-sm font-semibold shadow-lg">
                    <i class="fas fa-star mr-1"></i> Most Popular Enterprise
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">ZMW 2,499</div>
                    <div class="text-gray-600 mb-8">per month + transaction fees</div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700 font-semibold">Unlimited transactions</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Priority phone & chat support</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Advanced analytics & reporting</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Full API access</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Custom integrations</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Dedicated account manager</span>
                        </div>
                    </div>

                    <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                        Choose Enterprise
                    </a>
                </div>
            </div>

            <!-- Custom Plan -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-crown text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">White Label</h3>
                    <div class="text-4xl font-bold text-purple-600 mb-2">Custom</div>
                    <div class="text-gray-600 mb-8">Tailored enterprise solution</div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Custom branded solution</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">On-premise deployment</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">24/7 dedicated support</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Custom SLAs</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">Advanced security features</span>
                        </div>
                    </div>

                    <a href="mailto:sales@tigula.co.zm" class="block w-full bg-purple-600 text-white py-4 rounded-xl font-semibold hover:bg-purple-700 transition-colors text-center">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="py-24 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <div class="mb-8">
            <i class="fas fa-handshake text-6xl text-white/80 mb-6"></i>
        </div>
        <h2 class="text-4xl font-bold mb-6">
            Ready to Elevate Your Business
            <span class="block">with Enterprise-Grade Payments?</span>
        </h2>
        <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
            Join the growing number of professional operations choosing TIGULA for secure,
            compliant, and scalable digital payment solutions.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center bg-white text-blue-600 px-10 py-4 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200 group">
                    <i class="fas fa-rocket-launch mr-3 group-hover:translate-x-1 transition-transform"></i>
                    Start Your Professional Journey
                </a>
                <a href="mailto:sales@tigula.co.zm" class="inline-flex items-center border-2 border-white text-white px-10 py-4 rounded-xl font-semibold hover:bg-white hover:text-blue-600 transition-all duration-200">
                    <i class="fas fa-envelope mr-3"></i>
                    Speak with Our Team
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="inline-flex items-center bg-white text-blue-600 px-10 py-4 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200">
                    <i class="fas fa-arrow-right mr-3"></i>
                    Access Your Dashboard
                </a>
            @endguest
        </div>
    </div>
</section>

<!-- Professional Footer -->
<footer class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-seedling text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        TIGULA
                    </span>
                </div>
                <p class="text-gray-400 mb-4">
                    Enterprise-grade digital grain payments platform trusted by professionals across Zambia.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-linkedin text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook text-lg"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Product</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Security</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">API Documentation</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Support</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Compliance</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Security</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © 2025 TIGULA. All rights reserved. Licensed by Bank of Zambia.
                </p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i class="fas fa-shield-alt text-green-500"></i>
                        <span>SSL Secured</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i class="fas fa-lock text-blue-500"></i>
                        <span>PCI Compliant</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i class="fas fa-award text-purple-500"></i>
                        <span>ISO 27001</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@endsection

@push('styles')
<style>
    /* TIGULA Landing Page Styles */
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

    /* Mobile responsive improvements */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
    }
</style>
@endpush
