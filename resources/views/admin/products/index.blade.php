<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Data Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Admin Panel</h1>
        <a href="{{ route('logout') }}" 
           class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            Logout
        </a>
    </nav>

    <div class="max-w-6xl mx-auto mt-8 px-4">
        
        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Motor Bekas</h2>

            <a href="{{ route('motor.create') }}"
               class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                + Tambah Motor
            </a>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
            <table class="min-w-full text-left border-collapse">

                <thead>
                    <tr class="bg-gray-200 border-b">
                        <th class="p-3">Gambar</th>
                        <th class="p-3">Nama Motor</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Tahun</th>
                        <th class="p-3">Deskripsi</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($motors as $motor)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            <img src="{{ asset('storage/' . $motor->gambar) }}" 
                                 class="w-20 h-20 object-cover rounded-md">
                        </td>

                        <td class="p-3">{{ $motor->nama }}</td>

                        <td class="p-3">Rp{{ number_format($motor->harga, 0, ',', '.') }}</td>

                        <td class="p-3">{{ $motor->tahun }}</td>

                        <td class="p-3">{{ $motor->deskripsi }}</td>

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('motor.edit', $motor->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('motor.destroy', $motor->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

</body>
</html>
