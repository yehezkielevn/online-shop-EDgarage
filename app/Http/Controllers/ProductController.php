<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. TAMPILKAN DAFTAR PRODUK
    public function index()
    {
        // Hanya tampilkan produk yang belum terjual (tersedia atau pending_checkout)
        $products = Product::where('status', '!=', 'terjual')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.products.create');
    }

    // 3. PROSES SIMPAN DATA (STORE)
    public function store(Request $request)
    {
        // VALIDASI DATA
        $validated = $request->validate([
            'nama_motor'    => 'required|string|max:255',
            'merek'         => 'required|string',
            'tipe'          => 'required|string', // Gunakan 'tipe' sesuai DB
            'tahun'         => 'required|numeric',
            'warna'         => 'required|string',
            'harga'         => 'required|numeric', // Pastikan ini numeric
            'status_surat'  => 'required|string',
            'status_pajak'  => 'required|string',
            
            // Field yang boleh kosong (Nullable)
            'kilometer'     => 'nullable|numeric',
            'plat_nomor'    => 'nullable|string',
            'minus'         => 'nullable|string',
            
            // Validasi Gambar (Banyak File)
            'gambar.*'      => 'image|mimes:jpeg,png,jpg|max:5120', // Max 5MB per foto
        ]);

        // HANDLE MULTI UPLOAD GAMBAR
        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                // Simpan ke folder 'public/storage/products'
                $imagePaths[] = $file->store('products', 'public');
            }
        }

        // SIMPAN KE DATABASE
        Product::create([
            'nama_motor'    => $validated['nama_motor'],
            'merek'         => $validated['merek'],
            'tipe'          => $validated['tipe'], // Pastikan 'tipe'
            'tahun'         => $validated['tahun'],
            'warna'         => $validated['warna'],
            'harga'         => $validated['harga'],
            'kilometer'     => $validated['kilometer'] ?? 0,
            'plat_nomor'    => $validated['plat_nomor'] ?? '-',
            'status_surat'  => $validated['status_surat'],
            'status_pajak'  => $validated['status_pajak'],
            'minus'         => $validated['minus'] ?? 'Tidak ada',
            'gambar'        => $imagePaths, // Simpan array path foto
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Motor berhasil ditambahkan!');
    }

    // 4. FORM EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // 5. PROSES UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama_motor'    => 'required|string|max:255',
            'merek'         => 'required|string',
            'tipe'          => 'required|string',
            'tahun'         => 'required|numeric',
            'warna'         => 'required|string',
            'harga'         => 'required|numeric',
            'status_surat'  => 'required|string',
            'status_pajak'  => 'required|string',
            'kilometer'     => 'nullable|numeric',
            'plat_nomor'    => 'nullable|string',
            'minus'         => 'nullable|string',
            'gambar.*'      => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // SIAPKAN DATA UPDATE
        $dataToUpdate = [
            'nama_motor'    => $validated['nama_motor'],
            'merek'         => $validated['merek'],
            'tipe'          => $validated['tipe'],
            'tahun'         => $validated['tahun'],
            'warna'         => $validated['warna'],
            'harga'         => $validated['harga'],
            'kilometer'     => $validated['kilometer'] ?? $product->kilometer,
            'plat_nomor'    => $validated['plat_nomor'] ?? $product->plat_nomor,
            'status_surat'  => $validated['status_surat'],
            'status_pajak'  => $validated['status_pajak'],
            'minus'         => $validated['minus'],
        ];

        // CEK JIKA ADA UPLOAD GAMBAR BARU
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama (Opsional: kalau mau replace total)
            if ($product->gambar && is_array($product->gambar)) {
                foreach ($product->gambar as $oldImg) {
                    Storage::disk('public')->delete($oldImg);
                }
            }
            
            // Upload gambar baru
            $newImages = [];
            foreach ($request->file('gambar') as $file) {
                $newImages[] = $file->store('products', 'public');
            }
            $dataToUpdate['gambar'] = $newImages;
        }

        $product->update($dataToUpdate);

        return redirect()->route('admin.products.index')->with('success', 'Data motor berhasil diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar dari folder storage
        if ($product->gambar && is_array($product->gambar)) {
            foreach ($product->gambar as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Motor berhasil dihapus.');
    }
}