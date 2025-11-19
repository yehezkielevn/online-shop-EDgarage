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
            width: 100%;
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
            transition: background 0.3s ease-in-out;
        }
        .hero-overlay-figma.modal-active {
            background: rgba(0, 0, 0, 0.8);
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
<body class="bg-black scroll-smooth">
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
                        <a href="#katalog" class="nav-link">
                            Katalog
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
                    <a href="#" id="open-login-modal" class="login-button">
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
            <a href="#katalog" class="nav-link">Katalog</a>
            <a href="#tentang" class="nav-link">Tentang Kami</a>
            <a href="#kontak" class="nav-link">Kontak</a>
            <a href="#" id="open-login-modal-mobile" class="login-button text-center w-fit mt-2">Login</a>
        </div>
    </div>
    
    <!-- Hero Section -->
    @php
        $heroImage = file_exists(public_path('images/motor.jpg')) 
            ? asset('images/motor.jpg') 
            : 'https://images.unsplash.com/photo-1558980664-769d59546b3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80';
    @endphp
    <section class="hero-figma relative transition-all duration-300" id="hero-section" style="background-image: url('{{ $heroImage }}');">
        <!-- Overlay Hitam Transparan 50% -->
        <div class="hero-overlay-figma transition-colors duration-300 ease-in-out" id="hero-overlay"></div>
        
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
                <a href="#katalog" class="cta-button">
                    Lihat Stok Motor
                </a>
        </div>
    </section>
    
    <!-- Katalog Section -->
    <section id="katalog" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Katalog Motor</h2>
                <p class="text-gray-600 text-lg">Lihat daftar motor bekas berkualitas kami</p>
            </div>

            <!-- Grid Produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($motors as $motor)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 overflow-hidden">
                        <!-- Gambar -->
                        <div class="h-44 w-full bg-gray-100 overflow-hidden">
                            <img src="{{ $motor->image_url ?? 'https://picsum.photos/seed/motor'.$motor->id.'/800/600' }}" alt="{{ $motor->name }}" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4 space-y-3">
                            <!-- Nama Motor -->
                            <h3 class="text-lg font-bold text-gray-900">{{ $motor->name }}</h3>
                            
                            <!-- Brand dan Tahun -->
                            <div class="space-y-1">
                                <p class="text-sm text-gray-600">{{ $motor->brand }}</p>
                                <p class="text-xs text-gray-600">Tahun: {{ $motor->year }}</p>
                            </div>
                            
                            <!-- Harga -->
                            <div class="border-t border-gray-200 pt-3">
                                <p class="text-lg font-bold text-orange-600">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                            </div>
                            
                            <!-- Tombol Detail -->
                            <a href="{{ route('katalog.show', $motor) }}" class="inline-block w-full text-center bg-red-600 text-white font-semibold py-2 rounded-lg hover:bg-red-700 transition-colors duration-200">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600 text-lg">Tidak ada motor tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
    @include('sections.tentang')
    
    @include('sections.kontak')
    
    <!-- Login Modal -->
    <div id="login-overlay" class="fixed inset-0 hidden bg-[rgba(0,0,0,0.75)] backdrop-blur-sm z-40 transition-opacity duration-200" aria-hidden="true"></div>
    <div id="login-modal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="login-modal-title">
        <div class="mx-auto rounded-2xl shadow-2xl border border-gray-800 relative px-6 sm:px-8 py-8"
             style="background-color:#1f1f1f; width:min(100%,460px);">
            <button id="close-login-modal" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-[#E50914] focus:ring-offset-2 focus:ring-offset-[#1f1f1f] rounded transition" aria-label="Tutup modal">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="text-center">
                <h1 id="login-modal-title" class="text-3xl font-bold tracking-tight">
                    <span class="text-[#E50914]">E&amp;D</span><span class="text-white">garage</span>
                </h1>
                <p class="mt-3 text-lg font-medium text-white">Masuk ke Akun Anda</p>
                <p class="mt-1 text-sm text-gray-300">Masukkan kredensial untuk mengakses fitur lengkap</p>
            </div>
            @if ($errors->any())
                <div class="mt-6 rounded-md border border-red-700 bg-red-900/40 text-red-100 px-4 py-3 text-sm">
                    <ul class="list-disc list-inside space-y-1 text-left">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5" id="login-form">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="login-username" class="text-sm font-medium text-gray-200">Username</label>
                    <input
                        id="login-username"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        value="{{ old('email') }}"
                        placeholder="Masukkan username"
                        class="w-full rounded-md border border-transparent bg-[#2a2a2a] px-4 py-3 text-white placeholder-gray-400 focus:border-[#E50914] focus:outline-none focus:ring-2 focus:ring-[#E50914]/40 transition"
                    >
                </div>
                <div class="flex flex-col gap-2">
                    <label for="login-password" class="text-sm font-medium text-gray-200">Password</label>
                    <div class="relative">
                        <input
                            id="login-password"
                            name="password"
                            type="password"
                            required
                            placeholder="Masukkan password"
                            class="w-full rounded-md border border-transparent bg-[#2a2a2a] px-4 py-3 pr-12 text-white placeholder-gray-400 focus:border-[#E50914] focus:outline-none focus:ring-2 focus:ring-[#E50914]/40 transition"
                        >
                        <button
                            type="button"
                            id="toggle-password"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-[#E50914]/40 focus:ring-offset-2 focus:ring-offset-[#2a2a2a] rounded-md transition-colors duration-200"
                            aria-label="Tampilkan password"
                            aria-pressed="false"
                        >
                            <!-- Eye Open Icon -->
                            <svg id="eye-open-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-opacity duration-300 opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                            </svg>
                            <!-- Eye Closed Icon (with slash) -->
                            <svg id="eye-closed-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-opacity duration-300 opacity-0 absolute inset-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0 1 12 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 0 1 1.563-3.029m5.858.908a3 3 0 1 1 4.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0 1 12 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 0 1-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button
                    type="submit"
                    class="w-full rounded-md bg-[#E50914] py-3 font-semibold text-white transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#E50914]/40 focus:ring-offset-2 focus:ring-offset-[#1f1f1f] hover:bg-[#c20710] hover:shadow-lg hover:shadow-[#E50914]/50"
                    aria-label="Masuk ke dashboard admin"
                >
                    Masuk
                </button>
            </form>
            <p class="mt-4 text-center text-sm">
                <a href="{{ route('register.show') }}" class="font-medium text-white hover:text-[#E50914] transition-colors duration-300 ease-in-out">
                    Daftar Akun
                </a>
            </p>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const openLogin = document.getElementById('open-login-modal');
            const openLoginMobile = document.getElementById('open-login-modal-mobile');
            const loginModal = document.getElementById('login-modal');
            const loginOverlay = document.getElementById('login-overlay');
            const closeLogin = document.getElementById('close-login-modal');
            const togglePasswordButton = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('login-password');
            const heroOverlay = document.getElementById('hero-overlay');

            let focusableElements = [];
            let firstFocusableElement = null;
            let lastFocusableElement = null;
            let previouslyFocusedElement = null;
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            function showLoginModal(e) {
                if (e) e.preventDefault();
                previouslyFocusedElement = document.activeElement;
                loginModal.classList.remove('hidden');
                loginModal.classList.add('flex');
                loginOverlay?.classList.remove('hidden');
                heroOverlay?.classList.add('modal-active');
                document.body.classList.add('overflow-hidden');

                focusableElements = loginModal.querySelectorAll(
                    'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])'
                );
                firstFocusableElement = focusableElements[0] || null;
                lastFocusableElement = focusableElements[focusableElements.length - 1] || null;

                if (firstFocusableElement) {
                    firstFocusableElement.focus();
                }
            }
            function hideLoginModal(e) {
                if (e) e.preventDefault();
                loginModal.classList.add('hidden');
                loginModal.classList.remove('flex');
                loginOverlay?.classList.add('hidden');
                heroOverlay?.classList.remove('modal-active');
                document.body.classList.remove('overflow-hidden');
                if (previouslyFocusedElement) {
                    previouslyFocusedElement.focus();
                }
            }
            if (openLogin) openLogin.addEventListener('click', showLoginModal);
            if (openLoginMobile) openLoginMobile.addEventListener('click', function(e){
                showLoginModal(e);
                mobileMenu.classList.add('hidden');
            });
            if (loginOverlay) loginOverlay.addEventListener('click', hideLoginModal);
            if (closeLogin) closeLogin.addEventListener('click', hideLoginModal);

            loginModal?.addEventListener('keydown', function(event) {
                if (event.key === 'Tab') {
                    if (focusableElements.length === 0) return;
                    if (event.shiftKey) {
                        if (document.activeElement === firstFocusableElement) {
                            event.preventDefault();
                            lastFocusableElement?.focus();
                        }
                    } else {
                        if (document.activeElement === lastFocusableElement) {
                            event.preventDefault();
                            firstFocusableElement?.focus();
                        }
                    }
                }
                if (event.key === 'Escape') {
                    hideLoginModal(event);
                }
            });

            if (togglePasswordButton && passwordInput) {
                const eyeOpenIcon = document.getElementById('eye-open-icon');
                const eyeClosedIcon = document.getElementById('eye-closed-icon');
                
                togglePasswordButton.addEventListener('click', function() {
                    const isHidden = passwordInput.type === 'password';
                    passwordInput.type = isHidden ? 'text' : 'password';
                    togglePasswordButton.setAttribute('aria-pressed', String(isHidden));
                    togglePasswordButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
                    
                    // Animate eye icons
                    if (isHidden) {
                        // Show password - hide open icon, show closed icon
                        eyeOpenIcon.classList.add('opacity-0');
                        eyeOpenIcon.classList.remove('opacity-100');
                        eyeClosedIcon.classList.remove('opacity-0');
                        eyeClosedIcon.classList.add('opacity-100');
                    } else {
                        // Hide password - show open icon, hide closed icon
                        eyeOpenIcon.classList.remove('opacity-0');
                        eyeOpenIcon.classList.add('opacity-100');
                        eyeClosedIcon.classList.add('opacity-0');
                        eyeClosedIcon.classList.remove('opacity-100');
                    }
                });
            }

            // Auto open modal jika datang dari /login atau ada error validasi
            const urlParams = new URLSearchParams(window.location.search);
            const shouldOpen = urlParams.get('login') === '1' || @json(session('open_login', false));
            if (shouldOpen) {
                showLoginModal();
            }
            if (shouldOpen && loginModal.classList.contains('hidden')) {
                loginModal.classList.remove('hidden');
                loginModal.classList.add('flex');
                loginOverlay?.classList.remove('hidden');
                heroOverlay?.classList.add('modal-active');
            }

            // Smooth scroll for #katalog with offset for fixed navbar
            (function(){
                const navbarHeight = 70; // same as .navbar-figma height
                document.querySelectorAll('a[href="#katalog"]').forEach(function(link){
                    link.addEventListener('click', function(e){
                        // if link is for in-page navigation
                        e.preventDefault();
                        const target = document.getElementById('katalog');
                        if (!target) return;
                        const top = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                        window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
                        // close mobile menu if open
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                    });
                });
            })();
        });
    </script>
</body>
</html>
