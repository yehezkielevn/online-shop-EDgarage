<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_motor'   => 'required|string|max:255',
            'merek'        => 'required|string|max:255',
            'tipe'         => 'nullable|string|in:sport,manual,matic', // 🔥 DITAMBAHKAN
            'tahun'        => 'required|integer|min:1900|max:' . date('Y'),
            'warna'        => 'required|string|max:255',
            'harga'        => 'required|numeric|min:0',
            'kilometer'    => 'required|integer|min:0',
            'plat_nomor'   => 'required|string|max:20',
            'status_surat' => 'required|string',
            'status_pajak' => 'required|string',
            'minus'        => 'nullable|string',

            'images.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Simpan produk
        $product = Product::create($validated);

        // Simpan gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'order'      => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Motor berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        $product->load('images');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_motor'   => 'required|string|max:255',
            'merek'        => 'required|string|max:255',
            'tipe'         => 'nullable|string|in:sport,manual,matic', // 🔥 DITAMBAHKAN
            'tahun'        => 'required|integer|min:1900|max:' . date('Y'),
            'warna'        => 'required|string|max:255',
            'harga'        => 'required|numeric|min:0',
            'kilometer'    => 'required|integer|min:0',
            'plat_nomor'   => 'required|string|max:20',
            'status_surat' => 'required|string',
            'status_pajak' => 'required|string',
            'minus'        => 'nullable|string',

            'images.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'delete_images'=> 'nullable|array',
        ]);

        // Update data
        $product->update($validated);

        // Hapus gambar terpilih
        if ($request->delete_images) {
            foreach ($request->delete_images as $imageId) {
                $img = ProductImage::find($imageId);
                if ($img) {
                    Storage::disk('public')->delete($img->path);
                    $img->delete();
                }
            }
        }

        // Upload gambar baru
        if ($request->hasFile('images')) {
            $lastOrder = ProductImage::where('product_id', $product->id)->max('order') ?? 0;

            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'order'      => $lastOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Motor berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Motor berhasil dihapus!');
    }
}
