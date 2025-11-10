@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Motor</h1>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Nama Motor *</label>
                <input type="text" name="nama_motor" value="{{ old('nama_motor', $product->nama_motor) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Merek *</label>
                <input type="text" name="merek" value="{{ old('merek', $product->merek) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Tahun *</label>
                <input type="number" name="tahun" value="{{ old('tahun', $product->tahun) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Warna *</label>
                <input type="text" name="warna" value="{{ old('warna', $product->warna) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Harga (Rp) *</label>
                <input type="number" name="harga" value="{{ old('harga', $product->harga) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Kilometer *</label>
                <input type="number" name="kilometer" value="{{ old('kilometer', $product->kilometer) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Plat Nomor *</label>
                <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $product->plat_nomor) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Status Surat *</label>
                <input type="text" name="status_surat" value="{{ old('status_surat', $product->status_surat) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Status Pajak *</label>
                <select name="status_pajak" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="Masih berlaku" {{ $product->status_pajak === 'Masih berlaku' ? 'selected' : '' }}>Masih berlaku</option>
                    <option value="Habis" {{ $product->status_pajak === 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Minus</label>
                <textarea name="minus" class="w-full px-4 py-2 border rounded-lg">{{ old('minus', $product->minus) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-medium mb-2">Gambar (untuk mengganti, upload gambar baru)</label>
                @if($product->gambar)
                    <div class="mb-2 flex gap-2 flex-wrap">
                        @foreach($product->gambar as $img)
                            <img src="{{ asset('storage/' . $img) }}" alt="Gambar" class="w-20 h-20 object-cover rounded">
                        @endforeach
                    </div>
                @endif
                <input type="file" name="gambar[]" multiple accept="image/*" class="w-full px-4 py-2 border rounded-lg">
            </div>
        </div>
        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg">Update</button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection


