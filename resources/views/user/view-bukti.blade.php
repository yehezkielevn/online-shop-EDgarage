@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-32 pb-10 px-6">
    <div class="max-w-4xl mx-auto">
        
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('history') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium">Kembali ke Riwayat Pembelian</span>
            </a>
        </div>

        {{-- Header --}}
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-white mb-2">Bukti Transfer</h2>
            <div class="flex items-center gap-4 text-sm text-gray-400">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    ID Transaksi: #{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $transaction->created_at->format('d M Y, H:i') }}
                </span>
            </div>
        </div>

        {{-- Transaction Info Card --}}
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 mb-6">
            <div class="flex items-start gap-4">
                @if($transaction->product && $transaction->product->gambar && count($transaction->product->gambar) > 0)
                    <div class="w-20 h-20 bg-gray-800 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="{{ asset('storage/' . $transaction->product->gambar[0]) }}" 
                             alt="{{ $transaction->product->nama_motor }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif
                
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-white mb-1">
                        {{ $transaction->product ? $transaction->product->nama_motor : 'Produk Tidak Tersedia' }}
                    </h3>
                    @if($transaction->product)
                        <p class="text-sm text-gray-400 mb-2">
                            {{ $transaction->product->merek }} • {{ $transaction->product->tahun }}
                        </p>
                    @endif
                    <p class="text-xl font-bold text-red-500">
                        Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Status Badge --}}
                <div>
                    @if($transaction->status_pembayaran === 'pending')
                        <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-yellow-900/20 text-yellow-500 border border-yellow-900">
                            Pending
                        </span>
                    @elseif($transaction->status_pembayaran === 'lunas')
                        <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-green-900/20 text-green-500 border border-green-900">
                            Lunas
                        </span>
                    @elseif($transaction->status_pembayaran === 'ditolak')
                        <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-red-900/20 text-red-500 border border-red-900">
                            Ditolak
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Bukti Transfer Image --}}
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
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

            @if($transaction->catatan)
                <div class="mt-4 p-4 bg-gray-800 rounded-lg border border-gray-700">
                    <p class="text-sm text-gray-400 mb-1 font-semibold">Catatan:</p>
                    <p class="text-white">{{ $transaction->catatan }}</p>
                </div>
            @endif
        </div>

        {{-- Back Button (Bottom) --}}
        <div class="mt-6">
            <a href="{{ route('history') }}" class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Riwayat
            </a>
        </div>

    </div>
</div>
@endsection
