<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function index(Request $request)
    {
        // Brand pilihan
        $brands = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki'];

        // OPTIONAL kategori (jika ingin dipakai nanti)
        $categories = ['Sport', 'Matic'];

        $query = Motor::query();

        // Filter Brand
        if ($request->filled('brand') && in_array($request->brand, $brands)) {
            $query->where('brand', $request->brand);
        }

        // Filter Kategori
        if ($request->filled('category') && in_array($request->category, $categories)) {
            $query->where('type', $request->category);
        }

        // Filter Harga Min
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (int)$request->min_price);
        }

        // Filter Harga Max
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (int)$request->max_price);
        }

        // Filter Tahun
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Sorting
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;

            case 'year_asc':
                $query->orderBy('year', 'asc');
                break;

            default:
                $query->latest();
                break;
        }

        $motors = $query->paginate(12)->withQueryString();

        return view('katalog.index', compact('motors', 'brands', 'categories'));
    }

    public function show(Motor $motor)
    {
        return view('katalog.show', compact('motor'));
    }
}
