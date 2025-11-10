<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'product'])
            ->latest()
            ->paginate(15);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::where('is_admin', false)->get();
        $products = Product::all();
        return view('admin.transactions.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'metode_pembayaran' => 'required|in:Transfer Bank,E-Wallet,Cashless',
            'status_pembayaran' => 'required|in:pending,success,failed',
            'tanggal_transaksi' => 'required|date',
            'total_price' => 'required|numeric|min:0',
        ]);

        Transaction::create($validated);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'product']);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $users = User::where('is_admin', false)->get();
        $products = Product::all();
        return view('admin.transactions.edit', compact('transaction', 'users', 'products'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'metode_pembayaran' => 'required|in:Transfer Bank,E-Wallet,Cashless',
            'status_pembayaran' => 'required|in:pending,success,failed',
            'tanggal_transaksi' => 'required|date',
            'total_price' => 'required|numeric|min:0',
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
