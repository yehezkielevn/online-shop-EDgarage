<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin E&Dgarage')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #1f2937; }
        ::-webkit-scrollbar-thumb { background: #4b5563; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #6b7280; }
        
        /* Style untuk menu aktif */
        .nav-active {
            background-color: #DC2626; /* Red-600 */
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .nav-inactive {
            color: #9CA3AF; /* Gray-400 */
        }
        .nav-inactive:hover {
            background-color: #374151; /* Gray-700 */
            color: white;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-gray-800 border-r border-gray-700 hidden md:flex flex-col flex-shrink-0">
            <div class="h-16 flex items-center justify-center border-b border-gray-700 shadow-md">
                <h1 class="text-2xl font-bold text-white tracking-wider"><span class="text-red-600">E&D</span>garage</h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'nav-active' : 'nav-inactive' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.products.*') ? 'nav-active' : 'nav-inactive' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="font-medium">Kelola Produk</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.users.*') ? 'nav-active' : 'nav-inactive' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="font-medium">Kelola User</span>
                </a>

                <a href="{{ route('admin.transactions.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.transactions.*') ? 'nav-active' : 'nav-inactive' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span class="font-medium">Transaksi</span>
                </a>

                <div class="border-t border-gray-700 my-4"></div>
                
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-green-400 border border-green-600/30 hover:bg-green-900/20 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-medium">Lihat Website</span>
                </a>

                <div class="mt-auto pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Akun</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-400 hover:bg-red-900/20 hover:text-red-500 rounded-lg transition-colors group">
                            <svg class="w-5 h-5 mr-3 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="font-medium">Keluar</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden bg-gray-900">
            
            <header class="flex justify-between items-center py-4 px-6 bg-gray-800 border-b border-gray-700 flex-shrink-0">
                <h2 class="text-xl font-semibold text-white hidden md:block">@yield('header-title', 'Dashboard Overview')</h2>
                <span class="md:hidden text-red-600 font-bold text-xl">E&Dgarage</span>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <div class="text-right mr-3 hidden md:block">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">Administrator</p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>