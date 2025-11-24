@extends('layouts.admin')

@section('title', 'Bukti Transfer - E&Dgarage')
@section('header-title', 'Bukti Transfer')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <span class="font-medium">Kembali ke Manajemen Transaksi</span>
    </a>
</div>

{{-- Transaction Info --}}
<div class="bg-gray-800 rounded-xl border border-gray-700 p-6 mb-6">
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-bold text-white mb-4">Info Transaksi</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-xs text-gray-500 uppercase">ID Transaksi</label>
                    <p class="text-white font-mono">#{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Pembeli</label>
                    <p class="text-white font-medium">{{ $transaction->user->name }}</p>
                    <p class="text-gray-400 text-sm">{{ $transaction->user->email }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Tanggal</label>
                    <p class="text-white">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
        
        <div>
            <h3 class="text-lg font-bold text-white mb-4">Info Produk</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-xs text-gray-500 uppercase">Nama Motor</label>
                    <p class="text-white font-medium">{{ $transaction->product->nama_motor }}</p>
                    <p class="text-gray-400 text-sm">{{ $transaction->product->merek }} - {{ $transaction->product->tahun }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Harga</label>
                    <p class="text-2xl font-bold text-red-500">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Status</label>
                    <div class="mt-1">
                        @if($transaction->status_pembayaran === 'pending')
                            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-yellow-900/20 text-yellow-500 border border-yellow-900">
                                Pending
                            </span>
                        @elseif($transaction->status_pembayaran === 'lunas')
                            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-900/20 text-green-500 border border-green-900">
                                Lunas
                            </span>
                        @elseif($transaction->status_pembayaran === 'ditolak')
                            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-red-900/20 text-red-500 border border-red-900">
                                Ditolak
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($transaction->catatan)
        <div class="mt-6 pt-6 border-t border-gray-700">
            <label class="text-xs text-gray-500 uppercase block mb-2">Catatan dari Pembeli</label>
            <p class="text-white bg-gray-900 rounded-lg p-4">{{ $transaction->catatan }}</p>
        </div>
    @endif
</div>

{{-- Bukti Transfer Image --}}
<div class="bg-gray-800 rounded-xl border border-gray-700 p-6">
    <h3 class="text-lg font-bold text-white mb-4">Bukti Pembayaran</h3>
    
    <div class="bg-black rounded-lg overflow-hidden border border-gray-700">
        @if($transaction->bukti_transfer)
            <img src="{{ asset('storage/' . $transaction->bukti_transfer) }}" 
                 alt="Bukti Transfer #{{ $transaction->id }}"
                 class="w-full h-auto">
        @else
            <div class="p-12 text-center text-gray-500">
                <svg class="mx-auto h-16 w-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p>Bukti transfer tidak tersedia</p>
            </div>
        @endif
    </div>
</div>

{{-- Action Buttons --}}
@if($transaction->status_pembayaran === 'pending')
    <div class="mt-6 flex gap-3">
        <form action="{{ route('admin.transactions.verify', $transaction->id) }}" method="POST" class="flex-1">
            @csrf
            <button type="submit" onclick="return confirm('Verifikasi transaksi ini? Produk akan ditandai sebagai terjual.')" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Verifikasi Pembayaran
            </button>
        </form>
        
        <form action="{{ route('admin.transactions.reject', $transaction->id) }}" method="POST" class="flex-1">
            @csrf
            <button type="submit" onclick="return confirm('Tolak transaksi ini? Produk akan dikembalikan ke katalog.')" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tolak Pembayaran
            </button>
        </form>
    </div>
@endif

{{-- Back Button (Bottom) --}}
<div class="mt-6">
    <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Manajemen Transaksi
    </a>
</div>

@endsection
