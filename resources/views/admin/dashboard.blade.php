@extends('layouts.admin')

@section('title', 'Dashboard - E&Dgarage')
@section('header-title', 'Dashboard Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-lg hover:border-red-600/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Produk</p>
                    <p class="text-3xl font-bold text-white">{{ $totalProducts }} <span class="text-sm font-normal text-gray-500">Unit</span></p>
                </div>
                <div class="p-3 bg-blue-900/20 rounded-lg text-blue-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-lg hover:border-red-600/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Pengguna Terdaftar</p>
                    <p class="text-3xl font-bold text-white">{{ $totalUsers }} <span class="text-sm font-normal text-gray-500">Akun</span></p>
                </div>
                <div class="p-3 bg-green-900/20 rounded-lg text-green-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-lg hover:border-red-600/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Transaksi</p>
                    <p class="text-3xl font-bold text-white">{{ $totalTransactions }} <span class="text-sm font-normal text-gray-500">Order</span></p>
                </div>
                <div class="p-3 bg-red-900/20 rounded-lg text-red-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
            <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">Riwayat Login Terakhir</h3>
                <span class="text-xs text-gray-500">Realtime</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900/50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">User</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($loginActivities ?? [] as $log)
                            <tr class="hover:bg-gray-700/50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-white">{{ $log->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-xs">
                                    <span class="px-2 py-1 rounded-full {{ $log->role == 'admin' ? 'bg-red-900/30 text-red-400 border border-red-800' : 'bg-blue-900/30 text-blue-400 border border-blue-800' }}">
                                        {{ ucfirst($log->role) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($log->login_at)->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">Belum ada aktivitas login.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
            <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">Transaksi Terbaru</h3>
                <a href="{{ route('admin.transactions.index') }}" class="text-xs text-red-500 hover:text-red-400 hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900/50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">User</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($recentTransactions as $trx)
                            <tr class="hover:bg-gray-700/50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-white">{{ $trx->user->name ?? 'Deleted' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-400">{{ $trx->product->nama_motor ?? 'Deleted' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php
                                        $color = match($trx->status_pembayaran) {
                                            'success' => 'text-green-400',
                                            'pending' => 'text-yellow-400',
                                            'failed' => 'text-red-400',
                                            default => 'text-gray-400'
                                        };
                                    @endphp
                                    <span class="text-xs font-bold {{ $color }}">
                                        {{ ucfirst($trx->status_pembayaran) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">Belum ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection