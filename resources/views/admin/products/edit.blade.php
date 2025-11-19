<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-4">Edit Motor</h2>

        <form action="{{ route('motor.update', $motor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block mt-3 font-semibold">Nama Motor</label>
            <input type="text" name="nama"
                   class="w-full p-2 border rounded-lg"
                   value="{{ $motor->nama }}" required>

            <label class="block mt-3 font-semibold">Harga</label>
            <input type="number" name="harga"
                   class="w-full p-2 border rounded-lg"
                   value="{{ $motor->harga }}" required>

            <label class="block mt-3 font-semibold">Tahun</label>
            <input type="number" name="tahun"
                   class="w-full p-2 border rounded-lg"
                   value="{{ $motor->tahun }}" required>

            <label class="block mt-3 font-semibold">Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full p-2 border rounded-lg" required>{{ $motor->deskripsi }}</textarea>

            <label class="block mt-3 font-semibold">Gambar Sekarang:</label>
            <img src="{{ asset('storage/' . $motor->gambar) }}"
                 class="w-32 h-32 object-cover rounded-md mb-3">

            <label class="block mt-3 font-semibold">Ganti Gambar</label>
            <input type="file" name="gambar"
                   class="w-full p-2 border rounded-lg">

            <button class="w-full mt-5 bg-yellow-600 text-white p-2 rounded-lg hover:bg-yellow-700">
                Update
            </button>

        </form>

    </div>

</body>
</html>
