<nav class="fixed top-0 left-0 w-full h-20 z-50 bg-black/90 backdrop-blur-md border-b border-white/10 flex items-center">
    <div class="max-w-7xl mx-auto w-full px-6 flex items-center justify-between">

        <a href="/" class="text-2xl font-extrabold tracking-tight flex items-center gap-1 text-white no-underline">
            <span class="text-red-600">E&D</span><span class="text-white">garage</span>
        </a>

        <div class="flex items-center gap-8">
            
            <ul class="hidden md:flex items-center gap-8 text-gray-300 font-medium text-sm list-none m-0 p-0">
                <li><a href="/#hero" class="hover:text-red-500 transition text-gray-300 no-underline">Beranda</a></li>
                <li><a href="/#katalog" class="hover:text-red-500 transition text-gray-300 no-underline">Katalog</a></li>
                <li><a href="/#tentang" class="hover:text-red-500 transition text-gray-300 no-underline">Tentang Kami</a></li>
                <li><a href="/#kontak" class="hover:text-red-500 transition text-gray-300 no-underline">Kontak</a></li>
            </ul>

            <div class="relative flex items-center gap-5">
                @auth
                    @if(Auth::user()->role === 'admin' || Auth::user()->is_admin == 1)
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full text-sm font-bold transition shadow-lg no-underline">
                            Dashboard
                        </a>

                    @else
                        {{-- Cart Icon --}}
                        <a href="{{ route('cart') }}" class="relative text-gray-300 hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @php
                                $cartCount = auth()->user()->carts->count();
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-2 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $cartCount }}</span>
                            @endif
                        </a>

                        {{-- User Dropdown --}}
                        <div class="relative">
                            <button onclick="toggleUserDropdown()" class="flex items-center focus:outline-none gap-2">
                                <div class="w-9 h-9 rounded-full overflow-hidden border-2 border-gray-700 hover:border-red-600 transition flex-shrink-0">
                                    @if(Auth::user()->foto_profil)
                                        <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-800 flex items-center justify-center text-white font-bold text-sm">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div id="userMenuDropdown" class="absolute right-0 top-12 w-56 bg-[#151515] rounded-xl shadow-2xl border border-gray-800 overflow-hidden hidden transform transition-all duration-200 origin-top-right z-50">
                                <div class="px-4 py-3 border-b border-gray-800 bg-white/5">
                                    <p class="text-white text-sm font-bold truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="py-2">
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-red-600 hover:text-white transition no-underline">Profil Saya</a>
                                    <a href="{{ route('history') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-red-600 hover:text-white transition no-underline">Riwayat Pembelian</a>
                                </div>
                                <div class="border-t border-gray-800 p-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center px-3 py-2 text-sm text-red-500 hover:bg-red-900/30 rounded-lg transition">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                @else
                    <button onclick="toggleLogin(true)" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-full transition shadow-lg transform hover:scale-105">
                        Masuk
                    </button>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleUserDropdown() {
        const dropdown = document.getElementById('userMenuDropdown');
        dropdown.classList.toggle('hidden');
    }
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userMenuDropdown');
        const trigger = e.target.closest('button[onclick="toggleUserDropdown()"]');
        if (dropdown && !dropdown.classList.contains('hidden') && !trigger && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>