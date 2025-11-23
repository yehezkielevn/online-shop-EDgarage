<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;   // Panggil Model Transaction Asli
use App\Models\LoginActivity; // Panggil Model Activity Asli

class AdminController extends Controller
{
    public function index()
    {
        // 1. HITUNG TOTAL DATA (REAL DARI DB)
        $totalProducts = Product::count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalTransactions = Transaction::count(); 

        // 2. AMBIL RIWAYAT LOGIN (REAL DARI DB)
        // Mengambil 5 login terakhir
        $loginActivities = LoginActivity::latest()->take(5)->get();

        // 3. AMBIL TRANSAKSI TERBARU (REAL DARI DB)
        // Mengambil 5 transaksi terakhir beserta data user dan produknya
        $recentTransactions = Transaction::with(['user', 'product'])
                                ->latest()
                                ->take(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalUsers', 
            'totalTransactions', 
            'recentTransactions',
            'loginActivities'
        ));
    }

    // Halaman Log Aktivitas Lengkap
    public function activityLogs()
    {
        $activities = LoginActivity::latest()->paginate(20);
        return view('admin.activity_logs.index', compact('activities'));
    }
}