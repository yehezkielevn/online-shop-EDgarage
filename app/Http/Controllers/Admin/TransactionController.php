<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'product'])
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Menampilkan detail transaksi
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'product']);
        
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Verifikasi transaksi (terima pembayaran)
     */
    public function verify(Transaction $transaction)
    {
        // Update status pembayaran
        $transaction->update(['status_pembayaran' => 'lunas']);
        
        // Update status produk menjadi terjual
        $transaction->product->update(['status' => 'terjual']);
        
        return redirect()->back()->with('success', 'Transaksi berhasil diverifikasi. Produk telah terjual.');
    }

    /**
     * Tolak transaksi
     */
    public function reject(Request $request, Transaction $transaction)
    {
        // Validasi alasan penolakan
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255',
        ]);

        // Update status pembayaran dan simpan alasan di catatan
        $transaction->update([
            'status_pembayaran' => 'ditolak',
            'catatan' => $request->alasan_penolakan
        ]);
        
        // Kembalikan status produk menjadi tersedia
        $transaction->product->update(['status' => 'tersedia']);
        
        return redirect()->back()->with('error', 'Transaksi ditolak. Produk dikembalikan ke katalog.');
    }

    /**
     * View bukti transfer untuk admin
     */
    public function viewBukti(Transaction $transaction)
    {
        return view('admin.transactions.view-bukti', compact('transaction'));
    }
}
