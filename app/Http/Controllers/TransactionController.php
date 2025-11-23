<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Panggil Model Asli

class TransactionController extends Controller
{
    // TAMPILKAN SEMUA TRANSAKSI
    public function index()
    {
        // Ambil data real dari tabel transactions, gabungkan dengan user & product
        // Urutkan dari yang terbaru, batasi 10 per halaman
        $transactions = Transaction::with(['user', 'product'])
                            ->latest()
                            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    // UPDATE STATUS TRANSAKSI (REAL)
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:pending,success,failed'
        ]);

        $transaction = Transaction::findOrFail($id);
        
        $transaction->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    // HAPUS TRANSAKSI (REAL)
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return back()->with('success', 'Data transaksi berhasil dihapus.');
    }
}