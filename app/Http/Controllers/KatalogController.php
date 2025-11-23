<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Menampilkan halaman detail motor satuan.
     */
    public function show($id)
    {
        // Cari produk berdasarkan ID. 
        // Jika ID tidak ditemukan, otomatis muncul halaman 404 Not Found.
        $product = Product::findOrFail($id);

        // Kirim data produk ke view 'katalog.show'
        return view('katalog.show', compact('product'));
    }
}