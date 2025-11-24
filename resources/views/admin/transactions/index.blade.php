@extends('layouts.admin')

@section('title', 'Kelola Transaksi - E&Dgarage')
@section('header-title', 'Manajemen Transaksi')

@section('content')
<div class="mb-6">
    <p class="text-gray-400">Kelola dan verifikasi transaksi pembayaran dari pembeli</p>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="bg-green-900/30 border border-green-700 text-green-400 px-6 py-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-900/30 border border-red-700 text-red-400 px-6 py-4 rounded-lg mb-6">
        {{ session('error') }}
    </div>
@endif

{{-- Transactions Table  --}}
<div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-900">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Pembeli</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Bukti Transfer</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-750 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-mono">
                            #{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-white">
                            <div class="font-medium">{{ $transaction->user->name }}</div>
                            <div class="text-gray-400 text-xs">{{ $transaction->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-white">
                            <div class="font-medium">{{ $transaction->product->nama_motor }}</div>
                            <div class="text-gray-400 text-xs">{{ $transaction->product->merek }} - {{ $transaction->product->tahun }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-500">
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($transaction->bukti_transfer)
                                <a href="{{ route('admin.transactions.view-bukti', $transaction->id) }}" class="text-red-500 hover:text-red-400 hover:underline flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat
                                </a>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($transaction->status_pembayaran === 'pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-900/20 text-yellow-500 border border-yellow-900">
                                    Pending
                                </span>
                            @elseif($transaction->status_pembayaran === 'lunas')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-900/20 text-green-500 border border-green-900">
                                    Lunas
                                </span>
                            @elseif($transaction->status_pembayaran === 'ditolak')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-900/20 text-red-500 border border-red-900">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            {{ $transaction->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($transaction->status_pembayaran === 'pending')
                                <div class="flex gap-2">
                                    <button type="button" 
                                        onclick="openVerifyModal('#{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}', '{{ route('admin.transactions.verify', $transaction->id) }}')" 
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-xs font-bold transition flex items-center gap-1"
                                        title="Verifikasi Pembayaran">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Verifikasi
                                    </button>
                                    
                                    <button type="button" 
                                        onclick="openRejectModal('#{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}', '{{ route('admin.transactions.reject', $transaction->id) }}')" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md text-xs font-bold transition flex items-center gap-1"
                                        title="Tolak Transaksi">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Tolak
                                    </button>
                                </div>
                            @else
                                <span class="text-gray-500 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="font-medium">Belum ada transaksi</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL VERIFIKASI --}}
<div id="verifyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeModal('verifyModal')"></div>

    <!-- Modal Panel -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-xl bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-green-600/50">
            <div class="bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-900/30 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-bold leading-6 text-white" id="modal-title">Konfirmasi Verifikasi Pembayaran</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-300">
                                Apakah Anda yakin pembayaran untuk transaksi <span id="verifyTransactionId" class="font-bold text-green-400"></span> sudah valid dan ingin menyetujuinya?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-700">
                <form id="verifyForm" method="POST" action="">
                    @csrf
                    <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-green-600 px-3 py-2 text-sm font-bold text-white shadow-sm hover:bg-green-700 sm:ml-3 sm:w-auto transition-colors">
                        Ya, Verifikasi
                    </button>
                </form>
                <button type="button" onclick="closeModal('verifyModal')" class="mt-3 inline-flex w-full justify-center rounded-lg bg-gray-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-600 hover:bg-gray-600 sm:mt-0 sm:w-auto transition-colors">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeModal('rejectModal')"></div>

    <!-- Modal Panel -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-xl bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-red-600/50">
            <form id="rejectForm" method="POST" action="">
                @csrf
                <div class="bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-900/30 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-xl font-bold leading-6 text-white" id="modal-title">Konfirmasi Penolakan Pembayaran</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-300">
                                    Anda akan menolak transaksi <span id="rejectTransactionId" class="font-bold text-red-400"></span>. Tindakan ini tidak dapat dibatalkan.
                                </p>
                                <textarea name="alasan_penolakan" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white p-3 mt-4 focus:border-red-600 outline-none placeholder-gray-500 text-sm" placeholder="Tulis alasan penolakan di sini... (Wajib diisi)" required rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-700">
                    <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-bold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors">
                        Tolak Transaksi
                    </button>
                    <button type="button" onclick="closeModal('rejectModal')" class="mt-3 inline-flex w-full justify-center rounded-lg bg-gray-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-600 hover:bg-gray-600 sm:mt-0 sm:w-auto transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openVerifyModal(transactionId, actionUrl) {
        document.getElementById('verifyTransactionId').textContent = transactionId;
        document.getElementById('verifyForm').action = actionUrl;
        document.getElementById('verifyModal').classList.remove('hidden');
    }

    function openRejectModal(transactionId, actionUrl) {
        document.getElementById('rejectTransactionId').textContent = transactionId;
        document.getElementById('rejectForm').action = actionUrl;
        // Reset textarea
        document.querySelector('textarea[name="alasan_penolakan"]').value = '';
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal('verifyModal');
            closeModal('rejectModal');
        }
    });
</script>
@endsection