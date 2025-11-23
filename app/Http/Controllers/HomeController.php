<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. QUERY DATA
        // Kita ambil produk yang statusnya 'tersedia' (belum terjual)
        // Hapus 'with(images)' karena kita pakai JSON column 'gambar'
        $query = Product::latest(); 
        // Jika kamu sudah buat kolom 'status' di database, pakai baris ini:
        // $query = Product::where('status', 'tersedia')->latest();

        // === FILTER PENCARIAN ===
        if ($request->search) {
            // PERBAIKAN: Kolom di database adalah 'nama_motor', bukan 'nama'
            $query->where('nama_motor', 'LIKE', "%" . $request->search . "%");
        }

        if ($request->merek) {
            $query->where('merek', $request->merek);
        }

        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->tipe) {
            $query->where('tipe', $request->tipe);
        }

        // Ambil data dengan Pagination (12 per halaman)
        $products = $query->paginate(12);

        // === DATA DROPDOWN (Untuk Filter di View) ===
        $brands = Product::select('merek')->distinct()->whereNotNull('merek')->pluck('merek');

        $years = Product::select('tahun')
            ->distinct()
            ->whereNotNull('tahun')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $types = Product::select('tipe')
            ->distinct()
            ->whereNotNull('tipe')
            ->pluck('tipe');

        return view('home', compact('products', 'brands', 'years', 'types'));
    }
}