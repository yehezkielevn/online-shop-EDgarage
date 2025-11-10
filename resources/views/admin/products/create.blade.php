@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Motor Baru</h1>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Nama Motor *</label>
                <input type="text" name="nama_motor" value="{{ old('nama_motor') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Merek *</label>
                <input type="text" name="merek" value="{{ old('merek') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Tahun *</label>
                <input type="number" name="tahun" value="{{ old('tahun') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Warna *</label>
                <input type="text" name="warna" value="{{ old('warna') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Harga (Rp) *</label>
                <input type="number" name="harga" value="{{ old('harga') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Kilometer *</label>
                <input type="number" name="kilometer" value="{{ old('kilometer') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Plat Nomor *</label>
                <input type="text" name="plat_nomor" value="{{ old('plat_nomor') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Status Surat *</label>
                <input type="text" name="status_surat" value="{{ old('status_surat') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Status Pajak *</label>
                <select name="status_pajak" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="Masih berlaku">Masih berlaku</option>
                    <option value="Habis">Habis</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Minus</label>
                <textarea name="minus" class="w-full px-4 py-2 border rounded-lg">{{ old('minus') }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-medium mb-2">Gambar (bisa multiple)</label>
                <input type="file" name="gambar[]" multiple accept="image/*" class="w-full px-4 py-2 border rounded-lg">
            </div>
        </div>
        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection


