<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Motor - E&Dgarage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-900 text-white">
    <div class="max-w-4xl mx-auto my-10 p-6 bg-gray-800 rounded-xl border border-gray-700 shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Tambah Stok Motor</h2>
            <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-white">Kembali</a>
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

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div class="col-span-2">
                    <label class="text-gray-400 text-sm">Nama Motor</label>
                    <input type="text" name="nama_motor" value="{{ old('nama_motor') }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white placeholder-gray-600" placeholder="Contoh: Honda Vario 150 2019" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Merek</label>
                    <select name="merek" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        <option value="Honda" {{ old('merek') == 'Honda' ? 'selected' : '' }}>Honda</option>
                        <option value="Yamaha" {{ old('merek') == 'Yamaha' ? 'selected' : '' }}>Yamaha</option>
                        <option value="Suzuki" {{ old('merek') == 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                        <option value="Kawasaki" {{ old('merek') == 'Kawasaki' ? 'selected' : '' }}>Kawasaki</option>
                        <option value="Vespa" {{ old('merek') == 'Vespa' ? 'selected' : '' }}>Vespa</option>
                        <option value="Lainnya" {{ old('merek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Tipe</label>
                    <select name="tipe" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        <option value="Matic" {{ old('tipe') == 'Matic' ? 'selected' : '' }}>Matic</option>
                        <option value="Bebek" {{ old('tipe') == 'Bebek' ? 'selected' : '' }}>Bebek</option>
                        <option value="Sport" {{ old('tipe') == 'Sport' ? 'selected' : '' }}>Sport</option>
                        <option value="Trail" {{ old('tipe') == 'Trail' ? 'selected' : '' }}>Trail</option>
                        <option value="Classic" {{ old('tipe') == 'Classic' ? 'selected' : '' }}>Classic</option>
                    </select>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun') }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" placeholder="2020" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga') }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" placeholder="15000000" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Warna</label>
                    <input type="text" name="warna" value="{{ old('warna') }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" placeholder="Hitam Doff" required>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Kilometer</label>
                    <input type="number" name="kilometer" value="{{ old('kilometer') }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" placeholder="25000">
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Plat Nomor</label>
                    <input type="text" name="plat_nomor" value="{{ old('plat_nomor') }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" placeholder="B 1234 ABC">
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Status Surat</label>
                    <select name="status_surat" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        <option value="Lengkap" {{ old('status_surat') == 'Lengkap' ? 'selected' : '' }}>Lengkap (STNK+BPKB)</option>
                        <option value="STNK Only" {{ old('status_surat') == 'STNK Only' ? 'selected' : '' }}>STNK Only</option>
                        <option value="BPKB Only" {{ old('status_surat') == 'BPKB Only' ? 'selected' : '' }}>BPKB Only</option>
                        <option value="Non Surat" {{ old('status_surat') == 'Non Surat' ? 'selected' : '' }}>Non Surat</option>
                    </select>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Status Pajak</label>
                    <select name="status_pajak" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white">
                        <option value="Hidup" {{ old('status_pajak') == 'Hidup' ? 'selected' : '' }}>Hidup / Taat</option>
                        <option value="Mati" {{ old('status_pajak') == 'Mati' ? 'selected' : '' }}>Mati / Telat</option>
                    </select>
                </div>

                <div class="col-span-2 bg-gray-700/30 p-4 rounded border border-gray-600">
                    <label class="text-gray-300 text-sm font-bold block mb-2">Foto Galeri Motor (Bisa Pilih Banyak)</label>
                    
                    <input type="file" name="gambar[]" multiple accept="image/*" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700">
                    
                    <p class="text-xs text-gray-400 mt-2">
                        * Tahan tombol <strong>CTRL</strong> (Windows) atau <strong>Command</strong> (Mac) untuk memilih banyak foto.
                    </p>
                </div>

                <div class="col-span-2">
                    <label class="text-gray-400 text-sm">Minus / Catatan</label>
                    <textarea name="minus" class="w-full bg-gray-900 border border-gray-600 rounded p-3 mt-1 text-white" rows="3" placeholder="Contoh: Lecet pemakaian wajar...">{{ old('minus') }}</textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:scale-105">Simpan Data</button>
        </form>
    </div>
</body>
</html>