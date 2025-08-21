<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'petugasApp')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef1ff;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
            --sidebar-width: 280px;
            --transition-speed: 0.3s;
            --card-radius: 16px;
        }
        
        body {
            display: flex;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Sidebar with glass morphism effect */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(26, 26, 46, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: white;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sidebar-header h3 i {
            margin-right: 10px;
            color: var(--accent-color);
        }
        
        .sidebar-menu {
            padding: 20px 0;
            height: calc(100vh - 80px);
            overflow-y: auto;
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 14px 25px;
            margin: 5px 10px;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar a.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--accent-color);
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.2s ease;
        }
        
        .sidebar a:hover::before,
        .sidebar a.active::before {
            transform: scaleY(1);
        }
        
        .sidebar i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        /* Main content area */
        .content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            width: calc(100% - var(--sidebar-width));
            transition: all var(--transition-speed) ease;
            min-height: 100vh;
        }
        
        /* Modern navbar with glass effect */
        .navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: var(--dark-color);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            padding: 15px 25px;
            border-radius: var(--card-radius);
            margin-bottom: 25px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--dark-color) !important;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        .nav-link {
            color: #555 !important;
            padding: 8px 15px !important;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
        }
        
        .nav-link:hover {
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }
        
        /* User profile link */
        .user-profile {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 50px;
            transition: all var(--transition-speed) ease;
            text-decoration: none;
            color: var(--dark-color);
        }
        
        .user-profile:hover {
            background: rgba(67, 97, 238, 0.1);
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all var(--transition-speed) ease;
        }
        
        /* Logout button */
        .logout-btn {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-left: 10px;
        }
        
        /* Modern cards with glass effect */
        .card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            transition: all var(--transition-speed) ease;
            margin-bottom: 25px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        
        .card-header {
            background: rgba(255, 255, 255, 0.5);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 18px 25px;
            border-radius: var(--card-radius) var(--card-radius) 0 0 !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            transition: all var(--transition-speed) ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        }
        
        /* Alert notifications */
        .alert {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            display: flex;
            align-items: center;
        }
        
        .alert i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        /* Toggle button for mobile */
        #sidebarToggle {
            border: none;
            background: var(--primary-light);
            color: var(--primary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-speed) ease;
        }
        
        #sidebarToggle:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .content {
                margin-left: 0;
                width: 100%;
            }
            
            .content.active {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                opacity: 0;
                visibility: hidden;
                transition: all var(--transition-speed) ease;
            }
            
            .overlay.active {
                opacity: 1;
                visibility: visible;
            }
            
            /* Adjust profile/logout for mobile */
            .user-profile span {
                display: none;
            }
            
            .logout-btn span {
                display: none;
            }
            
            .logout-btn i {
                margin-right: 0;
            }
        }
        
        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Floating action button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.4);
            z-index: 100;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }
        
        .fab:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 15px 35px rgba(67, 97, 238, 0.5);
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    @php
        $user = Auth::user();
    @endphp

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-cash-register"></i>Kazir EZ</h3>
        </div>
        <div class="sidebar-menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }} animate__animated animate__fadeInLeft">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            @if ($user->role === 'admin')
                <a href="{{ url('produk') }}" class="{{ request()->is('produk') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.1s">
                    <i class="fas fa-cubes"></i> Kelola Produk
                </a>
                <a href="{{ url('pelanggan') }}" class="{{ request()->is('pelanggan') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.2s">
                    <i class="fas fa-users"></i> Pelanggan
                </a>
                <a href="{{ url('laporan') }}" class="{{ request()->is('laporan') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.3s">
                    <i class="fas fa-chart-pie"></i> Laporan
                </a>
                <a href="{{ url('register') }}" class="{{ request()->is('register') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.4s">
                    <i class="fas fa-user-plus"></i> Registrasi
                </a>
            @endif

            @if ($user->role === 'petugas')
                <a href="{{ url('transaksi') }}" class="{{ request()->is('transaksi') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.1s">
                    <i class="fas fa-receipt"></i> Transaksi
                </a>
                <a href="{{ url('produk') }}" class="{{ request()->is('produk') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.2s">
                    <i class="fas fa-cubes"></i> Kelola Produk
                </a>
                <a href="{{ url('pelanggan') }}" class="{{ request()->is('pelanggan') ? 'active' : '' }} animate__animated animate__fadeInLeft" style="animation-delay: 0.3s">
                    <i class="fas fa-users"></i> Pelanggan
                </a>
            @endif
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div class="overlay"></div>

    <!-- Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg animate__animated animate__fadeIn">
            <div class="container-fluid">
                <button class="navbar-toggler d-block d-lg-none" type="button" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="navbar-brand"><i class="fas @yield('icon', 'fa-tachometer-alt') me-2"></i>@yield('title', 'Dashboard')</span>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <!-- Profile Link -->
                        <li class="nav-item">
                            <a href="{{ route('profile.index') }}" class="nav-link user-profile">
                                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                                <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                            </a>
                        </li>
                        
                        <!-- Logout Button -->
                        <li class="nav-item ms-2">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm logout-btn">
                                    <i class="fas fa-sign-out-alt me-1"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Flash Message -->
        <div class="container-fluid mt-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Main Content -->
            <div class="fade-in">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Floating Action Button (can be used for quick actions) -->
    @hasSection('fab')
        @yield('fab')
    @endif

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Sidebar toggle functionality
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.content').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        });

        // Close sidebar when clicking on overlay
        document.querySelector('.overlay')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('active');
            document.querySelector('.content').classList.remove('active');
            this.classList.remove('active');
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.btn, .sidebar a, .card').forEach(element => {
            element.addEventListener('click', function(e) {
                // Skip if clicking on form elements
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'BUTTON' || e.target.tagName === 'SELECT' || e.target.tagName === 'TEXTAREA') {
                    return;
                }
                
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.className = 'ripple';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        });

        // Dynamic page transitions
        document.querySelectorAll('a:not([href^="#"]):not([target="_blank"])').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href && !this.classList.contains('no-transition')) {
                    e.preventDefault();
                    document.querySelector('.content').classList.add('animate__fadeOut');
                    
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 300);
                }
            });
        });

        // Add active class to current page in sidebar
        document.querySelectorAll('.sidebar a').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>