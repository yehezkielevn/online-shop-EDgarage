<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductCatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images');

        // Search (nama motor / merek)
        if ($search = $request->q) {
            $query->where(function($q_s) use ($search) {
                $q_s->where('nama_motor', 'like', "%{$search}%")
                    ->orWhere('merek', 'like', "%{$search}%");
            });
        }

        // Filter merek
        if ($brand = $request->brand) {
            $query->where('merek', $brand);
        }

        // Filter tipe
        if ($tipe = $request->tipe) {
            $query->where('tipe', $tipe);
        }

        // Filter tahun
        if ($year = $request->year) {
            $query->where('tahun', $year);
        }

        // Sorting
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'year_desc':
                $query->orderBy('tahun', 'desc');
                break;
            case 'year_asc':
                $query->orderBy('tahun', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Final data
        $products = $query->paginate(12)->withQueryString();

        // Dropdown Options
        $brands = Product::select('merek')->distinct()->whereNotNull('merek')->pluck('merek');
        $types  = Product::select('tipe')->distinct()->whereNotNull('tipe')->pluck('tipe');
        $years  = Product::select('tahun')->distinct()->whereNotNull('tahun')->orderBy('tahun', 'desc')->pluck('tahun');

        return view('katalog.index', compact('products', 'brands', 'types', 'years'));
    }

    public function show(Product $product)
    {
        $product->load('images');
        return view('katalog.show', compact('product'));
    }
}
