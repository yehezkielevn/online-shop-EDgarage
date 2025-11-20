@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-900 text-white shadow-lg rounded-xl p-6">

    <h2 class="text-2xl font-bold mb-6">Tambah Motor Bekas</h2>

    <form action="{{ route('admin.products.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Nama Motor</label>
            <input type="text" name="nama_motor"
                   class="w-full p-2 bg-gray-800 rounded-lg" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Merek</label>
            <input type="text" name="merek"
                   class="w-full p-2 bg-gray-800 rounded-lg">
        </div>

        <!-- ========== Tambahan Tipe Motor ========== -->
        <div>
            <label class="block font-semibold mb-1">Tipe Motor</label>
            <select name="tipe"
                    class="w-full p-2 bg-gray-800 rounded-lg text-white">
                <option value="">-- Pilih Tipe --</option>
                <option value="sport">Sport</option>
                <option value="manual">Manual</option>
                <option value="matic">Matic</option>
            </select>
        </div>
        <!-- ========================================= -->

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Tahun</label>
                <input type="number" name="tahun"
                       class="w-full p-2 bg-gray-800 rounded-lg">
            </div>

            <div>
                <label class="block font-semibold mb-1">Harga</label>
                <input type="number" name="harga"
                       class="w-full p-2 bg-gray-800 rounded-lg">
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Warna</label>
            <input type="text" name="warna"
                   class="w-full p-2 bg-gray-800 rounded-lg">
        </div>

        <div>
            <label class="block font-semibold mb-1">Kilometer</label>
            <input type="number" name="kilometer"
                   class="w-full p-2 bg-gray-800 rounded-lg">
        </div>

        <div>
            <label class="block font-semibold mb-1">Status Surat</label>
            <input type="text" name="status_surat"
                   class="w-full p-2 bg-gray-800 rounded-lg">
        </div>

        <div>
            <label class="block font-semibold mb-1">Status Pajak</label>
            <input type="text" name="status_pajak"
                   class="w-full p-2 bg-gray-800 rounded-lg">
        </div>

        <div>
            <label class="block font-semibold mb-1">Minus</label>
            <textarea name="minus"
                      class="w-full p-2 bg-gray-800 rounded-lg"></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Foto Motor</label>

            <input 
                type="file" 
                name="images[]" 
                multiple 
                accept="image/*"
                class="w-full p-2 bg-gray-800 rounded-lg"
            >

            <p class="text-gray-400 text-sm mt-1">
                * Bisa upload banyak foto.
            </p>
        </div>

        <button class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700 transition">
            Simpan
        </button>

    </form>

</div>
@endsection
