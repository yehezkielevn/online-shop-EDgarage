@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Transaksi</h1>
    <a href="{{ route('admin.transactions.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">+ Tambah Transaksi</a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pembeli</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Motor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($transactions as $transaction)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</td>
                <td class="px-6 py-4">{{ $transaction->user->name }}</td>
                <td class="px-6 py-4">{{ $transaction->product->nama_motor }}</td>
                <td class="px-6 py-4">{{ $transaction->metode_pembayaran }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-full text-xs {{ $transaction->status_pembayaran === 'success' ? 'bg-green-100 text-green-800' : ($transaction->status_pembayaran === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($transaction->status_pembayaran) }}
                    </span>
                </td>
                <td class="px-6 py-4">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.transactions.edit', $transaction) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $transactions->links() }}</div>
</div>
@endsection


