<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Query awal
        $query = Product::with('images')->latest();

        // === FILTER ===
        if ($request->search) {
            $query->where('nama', 'LIKE', "%" . $request->search . "%");
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

        $products = $query->get();

        // Dropdown
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
