<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    /**
     * Display a listing of motors with optional filters.
     */
    public function index(Request $request)
    {
        $brands = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki'];

        $query = Motor::query();

        // Brand filter (only allow known brands)
        if ($request->filled('brand') && in_array($request->brand, $brands)) {
            $query->where('brand', $request->brand);
        }

        // Price range filters
        if ($request->filled('min_price')) {
            $min = (int) str_replace(['.', ','], '', $request->min_price);
            $query->where('price', '>=', $min);
        }

        if ($request->filled('max_price')) {
            $max = (int) str_replace(['.', ','], '', $request->max_price);
            $query->where('price', '<=', $max);
        }

        // Year filter (exact match)
        if ($request->filled('year')) {
            $year = (int) $request->year;
            $query->where('year', $year);
        }

        // Sorting
        // allowed sorts: price_asc, price_desc, year_asc, year_desc
        $sort = $request->get('sort');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'year_asc':
                $query->orderBy('year', 'asc');
                break;
            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $motors = $query->paginate(12)->withQueryString();

        return view('katalog.index', compact('motors', 'brands'));
    }

    /**
     * Show motor detail
     */
    public function show(Motor $motor)
    {
        return view('katalog.show', compact('motor'));
    }
}
