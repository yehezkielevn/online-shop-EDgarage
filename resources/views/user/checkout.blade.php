@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-32 pb-10 px-6 flex justify-center">
    <div class="max-w-lg w-full bg-gray-900 rounded-2xl border border-gray-800 p-8 shadow-2xl">
        
        <h2 class="text-2xl font-bold mb-6 text-center border-b border-gray-800 pb-4">Konfirmasi Pembayaran</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-900/30 border border-green-700 text-green-400 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="bg-red-900/30 border border-red-700 text-red-400 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="bg-red-900/30 border border-red-700 text-red-400 px-4 py-3 rounded-lg mb-4">
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="font-semibold mb-1">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

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

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Upload Bukti Transfer <span class="text-red-500">*</span>
                </label>
                <input type="file" 
                       name="bukti_transfer" 
                       class="w-full bg-gray-800 text-gray-300 border border-gray-600 rounded-lg p-3 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-red-600 file:text-white hover:file:bg-red-700 file:cursor-pointer" 
                       required 
                       accept="image/jpeg,image/png,image/jpg">
                <p class="text-xs text-gray-500 mt-2">*Format: JPG, PNG. Maksimal 2MB.</p>
                @error('bukti_transfer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Catatan <span class="text-gray-500 text-xs">(Opsional)</span>
                </label>
                <textarea 
                    name="catatan" 
                    rows="3" 
                    class="w-full bg-gray-800 text-gray-300 border border-gray-600 rounded-lg p-3 focus:outline-none focus:border-red-500 transition"
                    placeholder="Tambahkan catatan jika diperlukan..."
                    maxlength="500">{{ old('catatan') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Maksimal 500 karakter</p>
                @error('catatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Kirim Bukti Pembayaran
            </button>
            
            <a href="{{ route('cart') }}" class="block text-center text-gray-500 mt-4 hover:text-white text-sm transition">Batal</a>
        </form>
    </div>
</div>
@endsection