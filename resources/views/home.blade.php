<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E&Dgarage - Tempat Terbaik Beli Motor Bekas Berkualitas</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar - Sesuai gambar contoh */
        .navbar-figma {
            background-color: #000000;
            height: 70px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 3rem;
        }
        
        .navbar-container {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        @media (min-width: 1024px) {
            .navbar-container {
                padding: 0 3rem;
            }
        }
        
        /* Navbar Menu - Spacing 24px sesuai gambar */
        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 24px; /* Spacing 24px sesuai permintaan */
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .navbar-menu li {
            margin: 0;
            padding: 0;
        }
        
        /* Navbar Link - Hover animasi dengan transisi 0.3s ease */
        .nav-link {
            position: relative;
            display: inline-block;
            color: #ffffff;
            font-weight: 500;
            font-size: 16px;
            text-decoration: none;
            transition: color 0.3s ease;
            padding-bottom: 2px;
        }
        
        .nav-link:hover {
            color: #e50914;
        }
        
        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 100%;
            height: 2px;
            background-color: #e50914;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        
        .nav-link:hover::after,
        .nav-link:focus::after {
            transform: scaleX(1);
        }
        
        .nav-link:focus {
            outline: 2px solid rgba(229, 9, 20, 0.2);
            outline-offset: 3px;
        }
        
        /* Logo Navbar - Styling khusus */
        .logo-brand {
            font-weight: 700;
            font-size: 1.25rem; /* text-xl - ukuran sedang */
        }
        
        .logo-brand .logo-ed {
            color: #e50914;
        }
        
        .logo-brand .logo-garage {
            color: #ffffff;
            text-transform: lowercase; /* Huruf kecil untuk "garage" */
            font-weight: 700; /* Font tebal */
        }
        
        /* Hero Section - Full height dengan background image motor */
        .hero-figma {
            min-height: 100vh;
            height: 100vh;
            /* Background image motor realistis - tema garasi/showroom motor bekas */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 70px; /* Offset untuk fixed navbar */
        }
        
        /* Overlay hitam transparan 50% opacity - menggunakan bg-black/50 */
        .hero-overlay-figma {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* 50% opacity - bg-black/50 */
        }
        
        /* Hero Content - Centered vertically and horizontally */
        .hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 1rem;
            width: 100%;
            max-width: 1200px;
        }
        
        /* Hero Title - Font size ~64px, styling sama dengan logo navbar */
        .hero-title {
            font-size: 64px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        
        .hero-title .hero-ed {
            color: #e50914;
        }
        
        .hero-title .hero-garage {
            color: #ffffff;
            text-transform: lowercase; /* Huruf kecil untuk "garage" seperti di navbar */
        }
        
        /* Hero Subtext */
        .hero-subtext {
            color: #ffffff;
            font-size: 20px;
            font-weight: 500;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }
        
        /* CTA Button - Rounded lg, merah dengan hover gelap */
        .cta-button {
            background-color: #e50914;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            padding: 12px 32px;
            border-radius: 0.5rem; /* rounded-lg */
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 1.5rem;
        }
        
        .cta-button:hover {
            background-color: #b8070f; /* Merah lebih gelap saat hover */
        }
        
        /* Login Button - Rounded full */
        .login-button {
            background-color: #e50914;
            color: #ffffff;
            font-weight: 500;
            font-size: 16px;
            padding: 10px 24px;
            border-radius: 9999px; /* rounded-full */
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        
        .login-button:hover {
            background-color: #b8070f;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-figma {
                padding: 0 1rem;
            }
            
            .navbar-container {
                padding: 0 1rem;
            }
            
            .hero-title {
                font-size: 48px;
            }
            
            .hero-subtext {
                font-size: 18px;
            }
            
            .navbar-menu {
                display: none;
            }
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-black">
    <!-- Navbar -->
    <nav class="navbar-figma">
        <div class="navbar-container">
            <!-- Logo -->
            <a href="/" class="logo-brand">
                <span class="logo-ed">E&D</span><span class="logo-garage">garage</span>
            </a>
            
            <!-- Menu Desktop -->
            <ul class="navbar-menu hidden md:flex">
                <li>
                    <a href="/" class="nav-link {{ request()->is('/') ? 'text-[#e50914]' : '' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="#motor" class="nav-link">
                        Motor
                    </a>
                </li>
                <li>
                    <a href="#tentang" class="nav-link">
                        Tentang Kami
                    </a>
                </li>
                <li>
                    <a href="#kontak" class="nav-link">
                        Kontak
                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="login-button">
                        Login
                    </a>
                </li>
            </ul>
            
            <!-- Menu Mobile Toggle -->
            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none focus:ring-2 focus:ring-[#e50914] focus:ring-offset-2 rounded p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden fixed top-[70px] left-0 right-0 bg-black z-50 border-t border-gray-800">
        <div class="flex flex-col px-6 py-4 space-y-4">
            <a href="/" class="nav-link {{ request()->is('/') ? 'text-[#e50914]' : '' }}">Beranda</a>
            <a href="#motor" class="nav-link">Motor</a>
            <a href="#tentang" class="nav-link">Tentang Kami</a>
            <a href="#kontak" class="nav-link">Kontak</a>
            <a href="{{ route('login') }}" class="login-button text-center w-fit mt-2">
                Login
            </a>
        </div>
    </div>
    
    <!-- Hero Section -->
    @php
        $heroImage = file_exists(public_path('images/motor.jpg')) 
            ? asset('images/motor.jpg') 
            : 'https://images.unsplash.com/photo-1558980664-769d59546b3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80';
    @endphp
    <section class="hero-figma" style="background-image: url('{{ $heroImage }}');">
        <!-- Overlay Hitam Transparan 50% -->
        <div class="hero-overlay-figma"></div>
        
        <!-- Content - Centered -->
        <div class="hero-content">
            <!-- Main Title -->
            <h1 class="hero-title">
                <span class="hero-ed">E&D</span><span class="hero-garage">garage</span>
            </h1>
            
            <!-- Subtext -->
            <p class="hero-subtext">
                Tempat Terbaik Beli Motor Bekas Berkualitas
            </p>
            
            <!-- CTA Button -->
            <a href="#motor" class="cta-button">
                Lihat Stok Motor
            </a>
        </div>
    </section>
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
