@extends('layouts.admin')

@section('title', 'Kelola Transaksi - E&Dgarage')
@section('header-title', 'Data Transaksi')

@section('content')
    @if(session('success'))
        <div class="bg-green-900/50 border border-green-600 text-green-300 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Produk</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-3 text-center text-xs text-gray-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($transactions as $trx)
                        <tr class="hover:bg-gray-700/50">
                            <td class="px-6 py-4 text-sm text-gray-500">#{{ $trx->id }}</td>
                            <td class="px-6 py-4 text-sm text-white">{{ $trx->user->name ?? 'User Dihapus' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $trx->product->nama_motor ?? 'Produk Dihapus' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.transactions.update', $trx->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status_pembayaran" onchange="this.form.submit()" class="bg-gray-900 text-xs border border-gray-600 rounded px-2 py-1 focus:outline-none focus:border-red-500 
                                        {{ $trx->status_pembayaran == 'success' ? 'text-green-400' : ($trx->status_pembayaran == 'failed' ? 'text-red-400' : 'text-yellow-400') }}">
                                        <option value="pending" {{ $trx->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="success" {{ $trx->status_pembayaran == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="failed" {{ $trx->status_pembayaran == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.transactions.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat transaksi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 bg-red-900/20 p-2 rounded hover:bg-red-900/50 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada transaksi apapun.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-700">{{ $transactions->links() }}</div>
    </div>
@endsection