@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Profil Admin</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-center">
            <div class="w-24 h-24 bg-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover">
                @else
                    <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                @endif
            </div>
            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
            <a href="{{ route('admin.profile.edit') }}" class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">Edit Profil</a>
        </div>
    </div>
    
    <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4">Informasi Profil</h3>
        <dl class="grid grid-cols-1 gap-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nomor HP</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $user->nomor_hp ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $user->alamat ?? '-' }}</dd>
            </div>
        </dl>
        
        <h3 class="text-lg font-semibold mb-4 mt-6">History Transaksi</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Motor</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                        <td class="px-4 py-2">{{ $transaction->product->nama_motor }}</td>
                        <td class="px-4 py-2">{{ $transaction->tanggal_transaksi->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ $transaction->status_pembayaran }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada transaksi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


