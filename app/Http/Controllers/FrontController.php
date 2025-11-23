<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    // 1. TAMBAH KE KERANJANG
    public function addToCart($id)
    {
        if (!Auth::check()) return redirect()->route('login');

        $exists = Cart::where('user_id', Auth::id())->where('product_id', $id)->exists();
        
        if(!$exists) {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id
            ]);
        }

        return redirect()->back()->with('success', 'Motor berhasil masuk keranjang!');
    }

    // 2. HALAMAN KERANJANG
    public function cart()
    {
        if (!Auth::check()) return redirect()->route('login');
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('user.cart', compact('carts'));
    }

    // 3. HAPUS ITEM KERANJANG
    public function deleteCart($id)
    {
        Cart::destroy($id);
        return back()->with('success', 'Item dihapus.');
    }

    // 4. HALAMAN CHECKOUT (UPLOAD BUKTI)
    public function checkoutPage(Request $request)
    {
        // Ambil ID produk yang dicentang dari keranjang
        $selectedIds = $request->input('selected_products');

        if (!$selectedIds || count($selectedIds) == 0) {
            return back()->with('error', 'Pilih minimal satu motor untuk di-checkout!');
        }

        // Ambil data cart berdasarkan ID yang dipilih
        $selectedCarts = Cart::whereIn('id', $selectedIds)->with('product')->get();
        $totalHarga = $selectedCarts->sum(fn($item) => $item->product->harga);

        return view('user.checkout', compact('selectedCarts', 'totalHarga'));
    }

    // 5. PROSES PEMBAYARAN FINAL
    public function processCheckout(Request $request)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'cart_ids' => 'required' // Array ID Cart yang dibeli
        ]);

        // Upload Bukti Transfer
        $buktiPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        $cartIds = explode(',', $request->cart_ids); // Convert string "1,2,3" ke array

        foreach ($cartIds as $cartId) {
            $cart = Cart::find($cartId);
            if($cart) {
                // Buat Transaksi
                Transaction::create([
                    'user_id' => Auth::id(),
                    'product_id' => $cart->product_id,
                    'amount' => $cart->product->harga,
                    'status_pembayaran' => 'pending',
                    'bukti_transfer' => $buktiPath, // Simpan Bukti
                    'created_at' => now()
                ]);

                // UPDATE STATUS MOTOR JADI TERJUAL (Supaya hilang dari katalog)
                $cart->product->update(['status' => 'terjual']);

                // Hapus dari keranjang
                $cart->delete();
            }
        }

        return redirect()->route('history')->with('success', 'Pembayaran dikirim! Menunggu konfirmasi admin.');
    }

    // 6. RIWAYAT & STRUK
    public function history()
    {
        $transactions = Transaction::where('user_id', Auth::id())->with('product')->latest()->get();
        return view('user.history', compact('transactions'));
    }
}