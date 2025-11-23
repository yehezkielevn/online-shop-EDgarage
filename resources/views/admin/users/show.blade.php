@extends('layouts.admin')

@section('title', 'Detail User - E&Dgarage')
@section('header-title', 'Detail Pengguna')

@section('content')
    <div class="max-w-3xl mx-auto w-full">
        
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar User
            </a>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
            
            <div class="px-6 py-6 border-b border-gray-700 flex items-center bg-gray-800/50">
                <div class="h-16 w-16 rounded-full bg-red-600 flex items-center justify-center text-2xl font-bold text-white mr-4 shadow-lg">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Role Akses</label>
                    <div class="mt-1">
                        @if($user->role === 'admin' || $user->is_admin)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-900/30 text-red-400 border border-red-800">
                                Administrator
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-900/30 text-blue-400 border border-blue-800">
                                User Biasa
                            </span>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Nomor HP</label>
                    <p class="text-lg font-medium mt-1 text-white">{{ $user->nomor_hp ?? '-' }}</p>
                </div>

                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Bergabung Sejak</label>
                    <p class="text-lg font-medium mt-1 text-white">{{ $user->created_at->format('d F Y') }}</p>
                </div>

                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Total Transaksi</label>
                    <p class="text-lg font-medium mt-1 text-white">
                        {{ $transactionCount ?? 0 }} <span class="text-sm text-gray-400">Kali Order</span>
                    </p>
                </div>
                
                <div class="col-span-2">
                    <label class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Alamat Lengkap</label>
                    <div class="mt-2 p-4 bg-gray-700/30 rounded-lg border border-gray-600 text-gray-300 leading-relaxed">
                        {{ $user->alamat ?? 'User ini belum melengkapi data alamat.' }}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection