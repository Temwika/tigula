<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Tigula - Smart Grain Trading Platform by Uplift Services Limited">

    <title>@yield('title', 'Tigula - Smart Grain Trading Platform')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        :root {
            --tigula-primary: #1a472a;
            --tigula-secondary: #d35400;
            --tigula-accent: #e67e22;
            --tigula-success: #27ae60;
            --tigula-warning: #f39c12;
            --tigula-danger: #e74c3c;
            --tigula-info: #3498db;
            --tigula-light: #ecf0f1;
            --tigula-dark: #2c3e50;
            --tigula-gradient: linear-gradient(135deg, #1a472a 0%, #d35400 100%);
            --tigula-gradient-accent: linear-gradient(135deg, #e67e22 0%, #f39c12 100%);
            --tigula-form-bg: #ffffff;
            --tigula-card-shadow: 0 6px 20px rgba(0,0,0,0.08);
            --tigula-border-radius: 12px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
        }

        .navbar {
            background: var(--tigula-gradient) !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-brand:hover {
            color: rgba(255,255,255,0.9) !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }

        .btn-primary {
            background: var(--tigula-gradient);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 85, 48, 0.3);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 35px rgba(0,0,0,0.12);
        }

        .card-custom {
            box-shadow: 0 8px 32px rgba(0,0,0,0.08) !important;
        }

        .card-header {
            background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: none;
            padding: 1.5rem;
        }

        .stats-card {
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--tigula-gradient);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-left: auto;
        }

        .action-card {
            display: block;
            text-decoration: none;
            color: inherit;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            background: white;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-color: var(--tigula-primary);
        }

        .action-card-content {
            padding: 1.5rem;
            text-align: center;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 1rem;
            border-radius: 10px;
            background: var(--tigula-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .hero-section {
            background: var(--tigula-gradient);
            color: white;
            padding: 80px 0;
            border-radius: 0 0 50px 50px;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            margin: 10px 0;
            border-left: 5px solid var(--tigula-primary);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--tigula-primary);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer {
            background: var(--tigula-dark);
            color: white;
            padding: 50px 0 20px;
            margin-top: 100px;
        }

        .footer h5 {
            color: var(--tigula-primary);
            margin-bottom: 20px;
        }

        .sidebar {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .menu-item {
            display: block;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 10px;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .menu-item:hover,
        .menu-item.active {
            background: var(--tigula-gradient);
            color: white;
            text-decoration: none;
        }

        .menu-item i {
            width: 20px;
            margin-right: 10px;
        }

        .page-title {
            color: var(--tigula-primary);
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--tigula-primary);
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 30px;
        }

        .breadcrumb-item a {
            color: var(--tigula-primary);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background: var(--tigula-primary);
            color: white;
            border: none;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #f8f9fa;
            vertical-align: middle;
        }

        .badge-custom {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }

        .alert-modern {
            border: none;
            border-radius: 15px;
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .card {
                margin-bottom: 20px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-seedling me-2"></i>
                TIGULA
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Admin
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('farmers.index') }}"><i class="fas fa-users"></i> Farmers</a></li>
                                    <li><a class="dropdown-item" href="{{ route('transactions.index') }}"><i class="fas fa-exchange-alt"></i> Transactions</a></li>
                                    <li><a class="dropdown-item" href="{{ route('payments.index') }}"><i class="fas fa-money-bill-wave"></i> Payments</a></li>
                                    <li><a class="dropdown-item" href="{{ route('grain-types.index') }}"><i class="fas fa-seedling"></i> Grain Types</a></li>
                                    <li><a class="dropdown-item" href="{{ route('depots.index') }}"><i class="fas fa-warehouse"></i> Depots</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('reports.index') }}"><i class="fas fa-chart-bar"></i> Reports</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('transactions.create') }}">
                                    <i class="fas fa-plus-circle"></i> New Transaction
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i> {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                @if(auth()->user()->role === 'admin')
                                    <span class="badge bg-warning ms-1">Admin</span>
                                @elseif(auth()->user()->role === 'super_admin')
                                    <span class="badge bg-danger ms-1">Super Admin</span>
                                @elseif(auth()->user()->role === 'farmer')
                                    <span class="badge bg-success ms-1">Farmer</span>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-home"></i> Dashboard
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    @auth
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <h5><i class="fas fa-seedling"></i> TIGULA</h5>
                    <p>Zambia's smartest grain trading platform by Uplift Services Limited.
                    Connecting farmers with markets efficiently and transparently.</p>
                    <p><strong>Vision:</strong> To revolutionize agriculture in Zambia through smart technology.</p>
                    <p><strong>Mission:</strong> Empowering farmers with fair pricing and instant payments.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Dashboard</a></li>
                        <li><a href="#" class="text-white-50">Transactions</a></li>
                        <li><a href="#" class="text-white-50">Payments</a></li>
                        <li><a href="#" class="text-white-50">Profile</a></li>
                        <li><a href="#" class="text-white-50">Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone"></i> +260 XXX XXX XXX</li>
                        <li><i class="fas fa-envelope"></i> info@tigula.zm</li>
                        <li><i class="fas fa-map-marker-alt"></i> Lusaka, Zambia</li>
                        <li><i class="fas fa-clock"></i> Mon-Fri: 8AM-6PM</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2025 Tigula - Smart Grain Trading Platform by Uplift Services Limited. All rights reserved.</p>
                    <small class="text-white-50">Powered by Laravel | Designed for Zambia</small>
                </div>
            </div>
        </div>
    </footer>
    @endauth

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Active menu highlighting
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });
        });

        // Success message auto-hide
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
