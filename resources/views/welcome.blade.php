<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIGULA - Zambia's Revolutionized Grain Trading Platform</title>
    <meta name="description" content="TIGULA - Smart digital grain trading platform connecting farmers, aggregators, and buyers with instant payments, SMS notifications, and real-time analytics.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

        :root {
            --tigula-primary: #059669;
            --tigula-secondary: #0d9488;
            --tigula-accent: #0891b2;
            --tigula-dark: #0f172a;
            --tigula-light: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        /* Advanced Background Animations */
        .mesh-gradient {
            background:
                radial-gradient(at 27% 37%, hsla(215, 98%, 61%, 1) 0px, transparent 0%),
                radial-gradient(at 97% 21%, hsla(125, 98%, 72%, 1) 0px, transparent 50%),
                radial-gradient(at 52% 99%, hsla(354, 98%, 61%, 1) 0px, transparent 50%),
                radial-gradient(at 10% 29%, hsla(256, 96%, 67%, 1) 0px, transparent 50%),
                radial-gradient(at 97% 96%, hsla(38, 60%, 74%, 1) 0px, transparent 50%),
                radial-gradient(at 33% 50%, hsla(222, 67%, 73%, 1) 0px, transparent 50%),
                radial-gradient(at 79% 53%, hsla(343, 68%, 79%, 1) 0px, transparent 50%);
            filter: blur(100px);
            opacity: 0.5;
            animation: gradientShift 20s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-30px, -30px) scale(1.1); }
            66% { transform: translate(30px, 30px) scale(0.9); }
        }

        /* Morphing Shapes */
        .morphing-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(ellipse 800px 600px at 50% 20%, rgba(120, 119, 198, 0.15), transparent),
                radial-gradient(ellipse 600px 800px at 80% 80%, rgba(255, 119, 198, 0.1), transparent),
                radial-gradient(ellipse 1000px 800px at 20% 70%, rgba(120, 216, 255, 0.1), transparent);
            animation: morphingShape 25s ease-in-out infinite;
        }

        @keyframes morphingShape {
            0%, 100% { border-radius: 60% 40% 30% 70%; }
            25% { border-radius: 40% 60% 70% 30%; }
            50% { border-radius: 30% 70% 60% 40%; }
            75% { border-radius: 70% 30% 40% 60%; }
        }

        /* Particle Animation */
        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .floating-particles::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle, rgba(120, 119, 198, 0.3) 1px, transparent 1px),
                radial-gradient(circle, rgba(255, 119, 198, 0.2) 1px, transparent 1px),
                radial-gradient(circle, rgba(120, 216, 255, 0.2) 1px, transparent 1px);
            background-size: 50px 50px, 60px 60px, 80px 80px;
            background-position: 0 0, 20px 30px, 40px 10px;
            animation: particlesFloat 30s linear infinite;
        }

        @keyframes particlesFloat {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-100px); }
        }

        /* Typography */
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .text-gradient {
            background: linear-gradient(135deg, #059669 0%, #0d9488 50%, #0891b2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass Effects */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Advanced Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
            border: none;
            border-radius: 16px;
            padding: 16px 32px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(5, 150, 105, 0.3);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(5, 150, 105, 0.4);
        }

        /* Card Animations */
        .feature-card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        .feature-card:hover {
            transform: translateY(-8px) rotate(2deg);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            border-color: rgba(5, 150, 105, 0.2);
        }

        /* Progress Animations */
        .progress-bar {
            height: 4px;
            background: linear-gradient(90deg, #059669, #0d9488, #0891b2);
            border-radius: 2px;
            animation: progressPulse 2s ease-in-out infinite;
        }

        @keyframes progressPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Scroll Effects */
        .scroll-fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .scroll-fade-in.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .hero-title {
                font-size: clamp(2rem, 10vw, 4rem);
            }

            .feature-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-900 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-seedling text-white text-lg"></i>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full animate-pulse"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold font-display bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent">
                            TIGULA
                        </h1>
                        <p class="text-xs text-gray-500 tracking-wider">SMART GRAIN TRADING</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#features" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 relative group">
                        Platform
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#process" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 relative group">
                        Process
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#features" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 relative group">
                        Features
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#testimonials" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 relative group">
                        Success Stories
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <div class="w-px h-6 bg-gray-300"></div>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 px-4 py-2">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            <i class="fas fa-rocket mr-2"></i>
                            Start Trading
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Dashboard
                        </a>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-3 rounded-xl text-gray-700 hover:text-emerald-600 hover:bg-gray-100 transition-colors duration-300" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-6 border-t border-gray-200/50 pt-6 space-y-4">
                <a href="#features" class="block text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 px-4 py-2 rounded-lg hover:bg-gray-50">
                    Platform
                </a>
                <a href="#process" class="block text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 px-4 py-2 rounded-lg hover:bg-gray-50">
                    Process
                </a>
                <a href="#features" class="block text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 px-4 py-2 rounded-lg hover:bg-gray-50">
                    Features
                </a>
                <a href="#testimonials" class="block text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 px-4 py-2 rounded-lg hover:bg-gray-50">
                    Success Stories
                </a>
                @guest
                    <div class="flex flex-col space-y-3 pt-4">
                        <a href="{{ route('login') }}" class="text-center text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-300 px-4 py-3 rounded-xl hover:bg-gray-50 border border-gray-200">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Start Trading
                        </a>
                    </div>
                @else
                    <a href="{{ route('dashboard') }}" class="btn-primary block text-center">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        Dashboard
                    </a>
                @endguest
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 mesh-gradient"></div>
        <div class="absolute inset-0 morphing-bg"></div>
        <div class="floating-particles"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-emerald-100/20 text-emerald-300 text-sm font-semibold rounded-full mb-8 border border-emerald-300/30 backdrop-blur-sm">
                <i class="fas fa-crown mr-2 text-emerald-400"></i>
                Built by Uplift Services Limited
            </div>

            <!-- Main Title -->
            <h1 class="hero-title font-display text-6xl lg:text-8xl font-black text-white mb-8 leading-tight">
                Revolutionizing
                <span class="block text-gradient">Grain Trading</span>
                in Zambia
            </h1>

            <!-- Subtitle -->
            <p class="text-xl lg:text-2xl text-white/80 max-w-4xl mx-auto mb-12 leading-relaxed">
                TIGULA connects farmers, aggregators, and buyers through intelligent digital solutions.
                Instant payments, real-time analytics, and complete traceability across the value chain.
            </p>

            <!-- Stats Bar -->
            <div class="flex flex-wrap justify-center gap-8 mb-12">
                <div class="glass-dark rounded-2xl px-6 py-4 min-w-[140px]">
                    <div class="text-3xl font-bold text-emerald-400 mb-1">15,000+</div>
                    <div class="text-white/70 text-sm font-medium">Active Farmers</div>
                </div>
                <div class="glass-dark rounded-2xl px-6 py-4 min-w-[140px]">
                    <div class="text-3xl font-bold text-teal-400 mb-1">ZMW 75M</div>
                    <div class="text-white/70 text-sm font-medium">Traded Value</div>
                </div>
                <div class="glass-dark rounded-2xl px-6 py-4 min-w-[140px]">
                    <div class="text-3xl font-bold text-cyan-400 mb-1">98.5%</div>
                    <div class="text-white/70 text-sm font-medium">Success Rate</div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                @guest
                    <a href="{{ route('register') }}" class="btn-primary">
                        <i class="fas fa-user-plus mr-2"></i>
                        Join TIGULA
                    </a>
                    <button class="glass rounded-2xl px-8 py-4 text-white font-semibold hover:bg-white/20 transition-colors duration-300">
                        <i class="fas fa-play-circle mr-2"></i>
                        Watch Demo
                    </button>
                @else
                    <a href="{{ route('dashboard') }}" class="btn-primary">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        Access Dashboard
                    </a>
                @endguest
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Process Section -->
    <section id="process" class="py-24 bg-white relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-emerald-200 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 font-display">
                    The TIGULA Process
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our streamlined digital workflow ensures transparency, efficiency, and fair pricing throughout the grain trading ecosystem.
                </p>
            </div>

            <!-- Process Steps -->
            <div class="relative">
                <!-- Connection Lines -->
                <div class="hidden lg:block absolute top-24 left-0 right-0 h-0.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"></div>

                <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                    <!-- Step 1: Farmer Registration -->
                    <div class="scroll-fade-in text-center group">
                        <div class="relative mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-user-check text-white text-2xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-lg">1</div>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Farmer Registration</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Complete digital registration with NRC verification, contact details, and location data.
                            Our secure system creates verified farmer profiles instantly.
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-emerald-500"></i>
                                <span>NRC Verification</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-emerald-500"></i>
                                <span>Phone & Location Data</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Real-time Weighing & Transaction -->
                    <div class="scroll-fade-in text-center group md:mt-12">
                        <div class="relative mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-weight-hanging text-white text-2xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-teal-500 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-lg">2</div>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Real-time Weighing</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Digital weighing with instant payment calculations. Multi-step approval ensures accuracy
                            and transparency at every stage of the transaction.
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-teal-500"></i>
                                <span>Live Weight Calculation</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-teal-500"></i>
                                <span>Multi-step Approval</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-teal-500"></i>
                                <span>Quality Assessment</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Instant Payment -->
                    <div class="scroll-fade-in text-center group md:mt-24">
                        <div class="relative mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-mobile-alt text-white text-2xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-cyan-500 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-lg">3</div>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Instant Payment</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Immediate mobile money payments via MTN, Airtel, and Zamtel. Farmers receive SMS
                            confirmations and the complete audit trail ensures total accountability.
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-cyan-500"></i>
                                <span>All Networks Supported</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-cyan-500"></i>
                                <span>SMS Confirmations</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-cyan-500"></i>
                                <span>Complete Audit Trail</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gradient-to-br from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 font-display">
                    Powerful Features
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    TIGULA delivers everything modern agricultural trading requires,
                    from real-time analytics to complete financial traceability.
                </p>
            </div>

            <!-- Feature Grid -->
            <div class="feature-grid grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Farmer Registration -->
                <div class="feature-card scroll-fade-in">
                    <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Digital Farmer Registration</h3>
                    <p class="text-gray-600 mb-4">
                        Comprehensive farmer profiles with NRC verification and biometric data.
                        Location tracking and contact verification ensure reliable transactions.
                    </p>
                </div>

                <!-- Real-time Weighing -->
                <div class="feature-card scroll-fade-in">
                    <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-balance-scale text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Real-time Weighing System</h3>
                    <p class="text-gray-600 mb-4">
                        Connected scales with instant calculations and quality assessments.
                        Eliminate weighing disputes with digital documentation.
                    </p>
                </div>

                <!-- Mobile Money Integration -->
                <div class="feature-card scroll-fade-in">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Mobile Money Integration</h3>
                    <p class="text-gray-600 mb-4">
                        Direct payments to MTN Money, Airtel Money, and Zamtel accounts.
                        Instant transactions with SMS confirmations for complete peace of mind.
                    </p>
                </div>

                <!-- SMS Notifications -->
                <div class="feature-card scroll-fade-in">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-sms text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Smart SMS Notifications</h3>
                    <p class="text-gray-600 mb-4">
                        Instant updates in local languages. Farmers, aggregators, and admins
                        receive real-time notifications for every transaction step.
                    </p>
                </div>

                <!-- Analytics Dashboard -->
                <div class="feature-card scroll-fade-in">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Analytics Dashboard</h3>
                    <p class="text-gray-600 mb-4">
                        Real-time insights into trading volumes, farmer performance, and profit margins.
                        Data-driven decisions for optimal agricultural trading.
                    </p>
                </div>

                <!-- Complete Audit Trail -->
                <div class="feature-card scroll-fade-in">
                    <div class="w-12 h-12 bg-gradient-to-r from-rose-500 to-pink-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Bank-Level Security</h3>
                    <p class="text-gray-600 mb-4">
                        Complete transaction audit trails with blockchain-verified records.
                        Multi-level authentication and encrypted data protection.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Dashboard Preview -->
    <section class="py-24 bg-gradient-to-r from-gray-900 via-slate-900 to-zinc-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"%3E%3Cg fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpolygon points="50,0 100,50 50,100 0,50"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center text-white mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-6 font-display">
                    Live TIGULA Dashboard
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Experience real-time trading data, instant notifications, and comprehensive analytics
                    that power Zambia's agricultural revolution.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Dashboard Mockup -->
                <div class="scroll-fade-in">
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-transform duration-500">
                        <!-- Dashboard Header -->
                        <div class="flex items-center justify-between mb-6 bg-gradient-to-r from-emerald-500 to-teal-500 p-4 rounded-t-2xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                    <i class="fas fa-chart-line text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-white font-bold text-lg">TIGULA Analytics</h3>
                                    <p class="text-white/80 text-sm">Real-time trading dashboard</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 bg-green-500/20 px-3 py-1 rounded-full backdrop-blur-sm">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-green-300 text-sm font-medium">LIVE</span>
                            </div>
                        </div>

                        <!-- Dashboard Content -->
                        <div class="space-y-6 p-6">
                            <!-- Key Metrics -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-4 rounded-xl border border-emerald-100">
                                    <div class="text-sm text-emerald-600 font-medium mb-1">Today's Revenue</div>
                                    <div class="text-2xl font-bold text-emerald-700">ZMW 125K</div>
                                    <div class="text-xs text-green-600 flex items-center mt-2">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        +12.5% from yesterday
                                    </div>
                                </div>
                                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-xl border border-blue-100">
                                    <div class="text-sm text-blue-600 font-medium mb-1">Active Farmers</div>
                                    <div class="text-2xl font-bold text-blue-700">342</div>
                                    <div class="text-xs text-green-600 flex items-center mt-2">
                                        <i class="fas fa-user-check mr-1"></i>
                                        Payments completed
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Transactions -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-history text-emerald-600 mr-2"></i>
                                    Recent Transactions
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user text-emerald-600"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Chileshe Mwale</div>
                                                <div class="text-sm text-gray-600">Maize • 45kg • ZMW 1,125</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Paid</span>
                                            <div class="text-xs text-gray-500 mt-1">2 mins ago</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-orange-50 rounded-xl">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-clock text-orange-600"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Mary Banda</div>
                                                <div class="text-sm text-gray-600">Soybeans • 32kg • Pending approval</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">Pending Admin</span>
                                    <div class="text-xs text-gray-500 mt-1">5 mins ago</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SMS Notifications Preview -->
                <div class="space-y-6">
                    <div class="glass-dark rounded-3xl p-6 border border-white/10">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-400 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-white font-medium">Payment Confirmed</span>
                                    <span class="text-green-300 text-sm">Just now</span>
                                </div>
                                <p class="text-white/90 leading-relaxed text-sm">
                                    "Thank you for trading with TIGULA. You have received ZMW 1,125 for 45kg of Maize.
                                    Reference: TXN-2025-0042. Safe trading!"
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-dark rounded-3xl p-6 border border-white/10">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-orange-400 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-white font-medium">Approval Required</span>
                                    <span class="text-orange-300 text-sm">1 min ago</span>
                                </div>
                                <p class="text-white/90 leading-relaxed text-sm">
                                    "Admin Review: Transaction TXN-2025-0043 (John Smith - 60kg Groundnuts)
                                    requires your final approval. Please review in the TIGULA dashboard."
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-dark rounded-3xl p-6 border border-white/10">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-heart text-blue-400 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-white font-medium">Welcome to TIGULA</span>
                                    <span class="text-blue-300 text-sm">Today</span>
                                </div>
                                <p class="text-white/90 leading-relaxed text-sm">
                                    "Welcome to TIGULA's digital grain trading revolution! Your profile has been verified
                                    and is ready for trading. Start earning more from your harvest today."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 font-display">
                    Success Stories
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Real farmers and aggregators share how TIGULA transformed their grain trading experience
                </p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Farmer Testimonial -->
                <div class="bg-gradient-to-br from-white to-emerald-50/50 p-8 rounded-3xl border border-emerald-100/50 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-1 mb-6">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <blockquote class="text-gray-700 text-lg leading-relaxed mb-6">
                        "TIGULA changed everything. No more waiting days for payments or worrying about transport.
                        Instant mobile money transfers and SMS confirmations give me peace of mind."
                    </blockquote>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold">
                            CM
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Chileshe Mwale</div>
                            <div class="text-gray-600 text-sm">Maize Farmer • Eastern Province</div>
                        </div>
                    </div>
                </div>

                <!-- Aggregator Testimonial -->
                <div class="bg-gradient-to-br from-white to-teal-50/50 p-8 rounded-3xl border border-teal-100/50 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-1 mb-6">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <blockquote class="text-gray-700 text-lg leading-relaxed mb-6">
                        "The real-time weighing and multi-step approval system eliminated all transaction disputes.
                        Farmers trust us more because they see fair, transparent pricing."
                    </blockquote>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold">
                            MK
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Micheal Kampamba</div>
                            <div class="text-gray-600 text-sm">Grain Aggregator • Lusaka</div>
                        </div>
                    </div>
                </div>

                <!-- Buyer Testimonial -->
                <div class="bg-gradient-to-br from-white to-cyan-50/50 p-8 rounded-3xl border border-cyan-100/50 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-1 mb-6">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <blockquote class="text-gray-700 text-lg leading-relaxed mb-6">
                        "TIGULA's complete traceability gives us confidence in our supply chain.
                        We can track every grain from farm to market, ensuring quality standards."
                    </blockquote>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center text-white font-bold">
                            JT
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">James Thomas</div>
                            <div class="text-gray-600 text-sm">Grain Buyer • Mill Owner</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Grain Prices Section -->
    <section class="py-24 bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 font-display">
                    Live Grain Prices
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Real-time pricing from across Zambia's agricultural markets, updated continuously
                </p>
            </div>

            <!-- Prices Grid -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold">Market Rates</h3>
                            <p class="text-emerald-100">Updated every 15 minutes</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="font-medium">LIVE</span>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">Grain Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">Current Price</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">24h Change</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">Trend</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">Last Update</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-seedling text-yellow-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">Maize</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-emerald-600">ZMW 185.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        +2.5%
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 h-2 bg-green-200 rounded-full mr-2">
                                            <div class="w-12 h-2 bg-green-500 rounded-full"></div>
                                        </div>
                                        <span class="text-green-600 text-sm font-medium">Bullish</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">2 minutes ago</td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-seedling text-green-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">Soybeans</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-emerald-600">ZMW 420.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        +1.8%
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 h-2 bg-green-200 rounded-full mr-2">
                                            <div class="w-10 h-2 bg-green-500 rounded-full"></div>
                                        </div>
                                        <span class="text-green-600 text-sm font-medium">Growing</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">5 minutes ago</td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-seedling text-orange-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">Groundnuts</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-emerald-600">ZMW 380.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-arrow-down mr-1"></i>
                                        -0.8%
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 h-2 bg-red-200 rounded-full mr-2">
                                            <div class="w-6 h-2 bg-red-500 rounded-full"></div>
                                        </div>
                                        <span class="text-red-600 text-sm font-medium">Declining</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">12 minutes ago</td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-seedling text-purple-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">Rice</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-emerald-600">ZMW 285.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        +3.2%
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 h-2 bg-green-200 rounded-full mr-2">
                                            <div class="w-14 h-2 bg-green-500 rounded-full"></div>
                                        </div>
                                        <span class="text-green-600 text-sm font-medium">Strong</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">1 minute ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-24 bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"%3E%3Cg fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="50" cy="50" r="1"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

        <div class="relative max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl lg:text-6xl font-bold text-white mb-6 font-display">
                    Ready to Transform Zambia's Agriculture?
                </h2>
                <p class="text-xl text-white/90 mb-12 leading-relaxed">
                    Join thousands of farmers, aggregators, and buyers who are already experiencing
                    the future of grain trading with TIGULA. Start your journey today.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-12">
                    @guest
                        <a href="{{ route('register') }}" class="btn-primary text-xl px-8 py-4">
                            <i class="fas fa-rocket mr-3"></i>
                            Start Trading Now
                        </a>
                        <a href="#features" class="glass rounded-2xl px-8 py-4 text-white font-semibold hover:bg-white/20 transition-colors duration-300">
                            <i class="fas fa-arrow-down mr-3"></i>
                            Learn More
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-primary text-xl px-8 py-4">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Access Dashboard
                        </a>
                    @endguest
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap justify-center gap-8 text-white/80">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-shield-alt text-xl"></i>
                        <span>Bank-Level Security</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-mobile-alt text-xl"></i>
                        <span>All Networks Supported</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-clock text-xl"></i>
                        <span>24/7 Support</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-users text-xl"></i>
                        <span>+500 Partners</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold font-display mb-2">TIGULA</h3>
                        <p class="text-gray-400">Smart Grain Trading Platform</p>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Revolutionizing Zambia's agricultural sector through innovative digital solutions.
                        Connecting farmers, aggregators, and buyers for transparent, efficient trading.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-emerald-600 transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-emerald-600 transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-emerald-600 transition-colors duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-emerald-600 transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Platform -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Platform</h4>
                    <ul class="space-y-4">
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors duration-300">Features</a></li>
                        <li><a href="#process" class="text-gray-400 hover:text-white transition-colors duration-300">How It Works</a></li>
                        @guest
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Sign In</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Get Started</a></li>
                        @endguest
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">API Documentation</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">System Status</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Security</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Company</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Press Kit</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Partners</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8 mt-12">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-400 text-sm mb-4 md:mb-0">
                        © 2025 TIGULA. Built by Uplift Services Limited. All rights reserved.
                    </div>
                    <div class="flex space-x-6 text-sm text-gray-400">
                        <a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition-colors duration-300">Terms of Service</a>
                        <a href="#" class="hover:text-white transition-colors duration-300">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('scroll-fade-in');
                }
            });
        }, observerOptions);

        // Observe elements for animations
        document.querySelectorAll('.scroll-fade-in').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Preload animations
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 TIGULA World-Class Platform Loaded Successfully!');
        });
    </script>
</body>
</html>
