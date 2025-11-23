<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. TAMPILKAN DAFTAR USER
    public function index()
    {
        // Ambil semua user terbaru, 10 per halaman
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. TAMPILKAN DETAIL USER (Hanya Lihat)
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        // Hitung transaksi user tersebut (jika ada relasi)
        $transactionCount = $user->transactions ? $user->transactions->count() : 0;

        return view('admin.users.show', compact('user', 'transactionCount'));
    }
}