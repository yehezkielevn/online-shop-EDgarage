<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'warna' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kilometer' => 'required|integer|min:0',
            'plat_nomor' => 'required|string|max:20',
            'status_surat' => 'required|string',
            'status_pajak' => 'required|string',
            'minus' => 'nullable|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('products', 'public');
            }
        }
        $validated['gambar'] = $gambarPaths;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Motor berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'warna' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kilometer' => 'required|integer|min:0',
            'plat_nomor' => 'required|string|max:20',
            'status_surat' => 'required|string',
            'status_pajak' => 'required|string',
            'minus' => 'nullable|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($product->gambar) {
                foreach ($product->gambar as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            // Upload gambar baru
            $gambarPaths = [];
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('products', 'public');
            }
            $validated['gambar'] = $gambarPaths;
        } else {
            $validated['gambar'] = $product->gambar;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Motor berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar
        if ($product->gambar) {
            foreach ($product->gambar as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Motor berhasil dihapus!');
    }
}
