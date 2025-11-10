@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Detail Motor</h1>
    <div class="flex gap-2">
        <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Edit</a>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Kembali</a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">{{ $product->nama_motor }}</h2>
        @if($product->gambar)
            <div class="mb-4 grid grid-cols-2 gap-2">
                @foreach($product->gambar as $img)
                    <img src="{{ asset('storage/' . $img) }}" alt="Gambar" class="w-full h-48 object-cover rounded-lg">
                @endforeach
            </div>
        @endif
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <dl class="space-y-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Merek</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->merek }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tahun</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->tahun }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Warna</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->warna }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Harga</dt>
                <dd class="mt-1 text-lg font-bold text-orange-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Kilometer</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ number_format($product->kilometer, 0, ',', '.') }} km</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Plat Nomor</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->plat_nomor }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status Surat</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->status_surat }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status Pajak</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $product->status_pajak }}</dd>
            </div>
            @if($product->minus)
            <div>
                <dt class="text-sm font-medium text-gray-500">Minus</dt>
                <dd class="mt-1 text-gray-900">{{ $product->minus }}</dd>
            </div>
            @endif
        </dl>
    </div>
</div>
@endsection


