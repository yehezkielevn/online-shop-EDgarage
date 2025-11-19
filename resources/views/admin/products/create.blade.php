<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-4">Tambah Motor Bekas</h2>

        <form action="{{ route('motor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block mt-3 font-semibold">Nama Motor</label>
            <input type="text" name="nama"
                   class="w-full p-2 border rounded-lg" required>

            <label class="block mt-3 font-semibold">Harga</label>
            <input type="number" name="harga"
                   class="w-full p-2 border rounded-lg" required>

            <label class="block mt-3 font-semibold">Tahun</label>
            <input type="number" name="tahun"
                   class="w-full p-2 border rounded-lg" required>

            <label class="block mt-3 font-semibold">Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full p-2 border rounded-lg" required></textarea>

            <label class="block mt-3 font-semibold">Gambar Motor</label>
            <input type="file" name="gambar"
                   class="w-full p-2 border rounded-lg" required>

            <button class="w-full mt-5 bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">
                Simpan
            </button>

        </form>

    </div>

</body>
</html>
