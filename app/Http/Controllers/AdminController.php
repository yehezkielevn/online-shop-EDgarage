<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalTransactions = Transaction::count();
        
        // Ambil 5 transaksi terbaru
        $recentTransactions = Transaction::with(['user', 'product'])
            ->latest()
            ->take(5)
            ->get();

        // Data untuk grafik penjualan (7 hari terakhir)
        $salesData = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $labels[] = $date->format('d M');
            
            $total = Transaction::whereDate('tanggal_transaksi', $dateStr)
                ->where('status_pembayaran', 'success')
                ->sum('total_price');
            
            // Pastikan nilai selalu numeric
            $salesData[] = is_numeric($total) ? (float) $total : 0.0;
        }
        
        // Pastikan selalu ada 7 data
        while (count($labels) < 7) {
            $labels[] = now()->subDays(7 - count($labels))->format('d M');
        }
        while (count($salesData) < 7) {
            $salesData[] = 0.0;
        }

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalTransactions',
            'recentTransactions',
            'salesData',
            'labels'
        ));
    }
}

