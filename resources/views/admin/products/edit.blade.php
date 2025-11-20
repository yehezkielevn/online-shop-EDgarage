@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-900 text-white shadow-lg rounded-xl p-6">

    <h2 class="text-2xl font-bold mb-6">Edit Motor</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Nama Motor</label>
            <input type="text" name="nama_motor"
                   class="w-full p-2 bg-gray-800 rounded-lg"
                   value="{{ $product->nama_motor }}" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Merek</label>
            <input type="text" name="merek"
                   class="w-full p-2 bg-gray-800 rounded-lg"
                   value="{{ $product->merek }}">
        </div>

        <!-- ========== Tambahan Tipe Motor ========== -->
        <div>
            <label class="block font-semibold mb-1">Tipe Motor</label>
            <select name="tipe"
                    class="w-full p-2 bg-gray-800 rounded-lg text-white">
                <option value="">-- Pilih Tipe --</option>
                <option value="sport" {{ $product->tipe == 'sport' ? 'selected' : '' }}>Sport</option>
                <option value="manual" {{ $product->tipe == 'manual' ? 'selected' : '' }}>Manual</option>
                <option value="matic" {{ $product->tipe == 'matic' ? 'selected' : '' }}>Matic</option>
            </select>
        </div>
        <!-- ========================================= -->

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Tahun</label>
                <input type="number" name="tahun"
                       class="w-full p-2 bg-gray-800 rounded-lg"
                       value="{{ $product->tahun }}">
            </div>

            <div>
                <label class="block font-semibold mb-1">Harga</label>
                <input type="number" name="harga"
                       class="w-full p-2 bg-gray-800 rounded-lg"
                       value="{{ $product->harga }}">
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Warna</label>
            <input type="text" name="warna"
                   class="w-full p-2 bg-gray-800 rounded-lg"
                   value="{{ $product->warna }}">
        </div>

        <div>
            <label class="block font-semibold mb-1">Kilometer</label>
            <input type="number" name="kilometer"
                   class="w-full p-2 bg-gray-800 rounded-lg"
                   value="{{ $product->kilometer }}">
        </div>

        <div>
            <label class="block font-semibold mb-1">Status Surat</label>
            <input type="text" name="status_surat"
                   class="w-full p-2 bg-gray-800 rounded-lg"
                   value="{{ $product->status_surat }}">
        </div>

        <div>
            <label class="block font-semibold mb-1">Status Pajak</label>
            <input type="text" name="status_pajak"
                   class="w-full p-2 bg-gray-800 rounded-lg"
                   value="{{ $product->status_pajak }}">
        </div>

        <div>
            <label class="block font-semibold mb-1">Minus</label>
            <textarea name="minus"
                      class="w-full p-2 bg-gray-800 rounded-lg">{{ $product->minus }}</textarea>
        </div>

        <!-- preview image lama -->
        <div>
            <label class="block font-semibold mb-2">Foto Lama</label>

            @foreach($product->images as $img)
                <img 
                    src="{{ asset('storage/'.$img->path) }}"
                    class="w-32 h-32 object-cover rounded-md inline-block mr-3 mb-3"
                >
            @endforeach
        </div>

        <!-- upload foto baru -->
        <div>
            <label class="block font-semibold mb-1">Upload Foto Baru</label>

            <input 
                type="file" 
                name="images[]" 
                multiple 
                accept="image/*"
                class="w-full p-2 bg-gray-800 rounded-lg"
            >
        </div>

        <button class="w-full bg-yellow-600 text-white p-3 rounded-lg hover:bg-yellow-700 transition">
            Update
        </button>

    </form>

</div>
@endsection
