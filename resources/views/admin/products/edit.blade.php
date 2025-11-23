<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Motor - E&Dgarage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-900 text-white">
    <div class="max-w-4xl mx-auto my-10 p-6 bg-gray-800 rounded-xl border border-gray-700 shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Edit Data: <span class="text-red-500">{{ $product->nama_motor }}</span></h2>
            <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-white">Batal</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-900/50 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div class="col-span-2">
                    <label class="text-gray-400 text-sm">Nama Motor</label>
                    <input type="text" name="nama_motor" value="{{ old('nama_motor', $product->nama_motor) }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Merek</label>
                    <select name="merek" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        @foreach(['Honda','Yamaha','Suzuki','Kawasaki','Vespa','Lainnya'] as $merek)
                            <option value="{{ $merek }}" {{ $product->merek == $merek ? 'selected' : '' }}>{{ $merek }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Tipe</label>
                    <select name="tipe" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        @foreach(['Matic','Bebek','Sport','Trail','Classic'] as $tipeOption)
                            <option value="{{ $tipeOption }}" {{ $product->tipe == $tipeOption ? 'selected' : '' }}>{{ $tipeOption }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun', $product->tahun) }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', $product->harga) }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Warna</label>
                    <input type="text" name="warna" value="{{ old('warna', $product->warna) }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Kilometer</label>
                    <input type="number" name="kilometer" value="{{ old('kilometer', $product->kilometer) }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Plat Nomor</label>
                    <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $product->plat_nomor) }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Status Surat</label>
                    <select name="status_surat" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        <option value="Lengkap" {{ $product->status_surat == 'Lengkap' ? 'selected' : '' }}>Lengkap (STNK+BPKB)</option>
                        <option value="STNK Only" {{ $product->status_surat == 'STNK Only' ? 'selected' : '' }}>STNK Only</option>
                        <option value="BPKB Only" {{ $product->status_surat == 'BPKB Only' ? 'selected' : '' }}>BPKB Only</option>
                        <option value="Non Surat" {{ $product->status_surat == 'Non Surat' ? 'selected' : '' }}>Non Surat</option>
                    </select>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Status Pajak</label>
                    <select name="status_pajak" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        <option value="Hidup" {{ $product->status_pajak == 'Hidup' ? 'selected' : '' }}>Hidup</option>
                        <option value="Mati" {{ $product->status_pajak == 'Mati' ? 'selected' : '' }}>Mati</option>
                    </select>
                </div>

                <div class="col-span-2 bg-gray-700/50 p-4 rounded-lg border border-gray-600">
                    <label class="text-gray-300 text-sm font-bold mb-2 block">Foto Galeri Motor (Upload baru untuk mengganti)</label>
                    
                    <input type="file" name="gambar[]" multiple accept="image/*" class="w-full bg-gray-900 border border-gray-600 rounded p-3 text-gray-300 mb-3">
                    <p class="text-xs text-gray-400 mb-4">*Tahan tombol CTRL untuk memilih banyak foto sekaligus.</p>

                    @if($product->gambar && is_array($product->gambar) && count($product->gambar) > 0)
                        <p class="text-xs text-green-400 mb-2">Foto Saat Ini:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->gambar as $img)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $img) }}" class="h-20 w-20 object-cover rounded border border-gray-500">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-span-2">
                    <label class="text-gray-400 text-sm">Minus / Catatan</label>
                    <textarea name="minus" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" rows="3">{{ old('minus', $product->minus) }}</textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:scale-105">Update Data Motor</button>
        </form>
    </div>
</body>
</html>