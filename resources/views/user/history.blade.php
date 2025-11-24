@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-32 pb-10 px-6">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">Riwayat Pembelian</h2>
            <p class="text-gray-400">Lihat semua pesanan dan status pembayaran Anda</p>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-900/30 border border-green-700 text-green-400 px-6 py-4 rounded-lg mb-6 flex items-center gap-3">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-900/30 border border-red-700 text-red-400 px-6 py-4 rounded-lg mb-6 flex items-center gap-3">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Transactions List --}}
        @forelse($transactions as $transaction)
            <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 mb-4 shadow-lg hover:border-gray-700 transition">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    
                    {{-- Left: Product Info --}}
                    <div class="flex items-start gap-4 flex-1">
                        {{-- Product Image --}}
                        <div class="w-24 h-24 bg-gray-800 rounded-lg overflow-hidden flex-shrink-0">
                            @if($transaction->product && $transaction->product->gambar && count($transaction->product->gambar) > 0)
                                <img src="{{ asset('storage/' . $transaction->product->gambar[0]) }}" 
                                     alt="{{ $transaction->product->nama_motor }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-600">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Product Details --}}
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-white mb-1">
                                {{ $transaction->product ? $transaction->product->nama_motor : 'Produk Tidak Tersedia' }}
                            </h3>
                            @if($transaction->product)
                                <p class="text-sm text-gray-400">
                                    {{ $transaction->product->merek }} • {{ $transaction->product->tahun }}
                                </p>
                            @endif
                            <p class="text-xl font-bold text-red-500 mt-2">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </p>
                            @if($transaction->catatan)
                                <p class="text-sm text-gray-500 mt-2">
                                    <span class="font-semibold">Catatan:</span> {{ $transaction->catatan }}
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Right: Status & Actions --}}
                    <div class="flex flex-col items-start lg:items-end gap-3">
                        {{-- Transaction ID & Date --}}
                        <div class="text-right">
                            <p class="text-xs text-gray-500 font-mono">ID: #{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                        </div>

                        {{-- Status Badge --}}
                        @if($transaction->status_pembayaran === 'pending')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-full bg-yellow-900/20 text-yellow-500 border border-yellow-900">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Menunggu Verifikasi
                            </span>
                        @elseif($transaction->status_pembayaran === 'lunas')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-full bg-green-900/20 text-green-500 border border-green-900">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pembayaran Lunas
                            </span>
                        @elseif($transaction->status_pembayaran === 'ditolak')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-full bg-red-900/20 text-red-500 border border-red-900">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pembayaran Ditolak
                            </span>
                        @endif

                        {{-- View Proof Button --}}
                        @if($transaction->bukti_transfer)
                            <a href="{{ route('history.bukti', $transaction->id) }}" 
                               class="text-red-500 hover:text-red-400 text-sm font-medium flex items-center gap-1 hover:underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Bukti Transfer
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="bg-gray-900 rounded-xl border border-gray-800 p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-400 mb-2">Belum Ada Riwayat Pembelian</h3>
                <p class="text-gray-500 mb-6">Anda belum melakukan pembelian apapun</p>
                <a href="/#katalog" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Jelajahi Motor
                </a>
            </div>
        @endforelse

    </div>
</div>
@endsection
