@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-32 pb-10 px-6 flex justify-center">
    <div class="max-w-lg w-full bg-gray-900 rounded-2xl border border-gray-800 p-8 shadow-2xl">
        
        <h2 class="text-2xl font-bold mb-6 text-center border-b border-gray-800 pb-4">Konfirmasi Pembayaran</h2>

        <div class="space-y-4 mb-6">
            <p class="text-gray-400 text-sm text-center">Silakan transfer ke rekening berikut:</p>
            <div class="bg-gray-800 p-4 rounded-lg text-center border border-gray-700">
                <p class="text-lg font-bold text-white">BCA: 123-456-7890</p>
                <p class="text-sm text-gray-400">a.n E&D Garage Official</p>
            </div>
            
            <div class="text-center">
                <p class="text-gray-400 text-sm">Total Tagihan:</p>
                <p class="text-3xl font-bold text-red-500">Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
            </div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="cart_ids" value="{{ $selectedCarts->pluck('id')->implode(',') }}">

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">Upload Bukti Transfer</label>
                <input type="file" name="bukti_transfer" class="w-full bg-gray-800 text-gray-300 border border-gray-600 rounded-lg p-3 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-red-600 file:text-white" required accept="image/*">
                <p class="text-xs text-gray-500 mt-2">*Format: JPG, PNG. Max 2MB.</p>
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:scale-[1.02]">
                Kirim Bukti Pembayaran
            </button>
            
            <a href="{{ route('cart') }}" class="block text-center text-gray-500 mt-4 hover:text-white text-sm">Batal</a>
        </form>
    </div>
</div>
@endsection