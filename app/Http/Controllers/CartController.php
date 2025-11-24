<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get();
        
        return view('user.cart', compact('carts'));
    }

    /**
     * Menambahkan produk ke keranjang
     */
    public function store(Product $product)
    {
        // Cek apakah produk tersedia
        if ($product->status !== 'tersedia') {
            return redirect()->back()->with('error', 'Produk ini tidak tersedia.');
        }

        // Cek apakah produk sudah ada di keranjang
        $exists = Cart::where('user_id', Auth::id())
                     ->where('product_id', $product->id)
                     ->exists();

        if ($exists) {
            return redirect()->route('cart')->with('info', 'Produk sudah ada di keranjang Anda.');
        }

        // Tambahkan ke keranjang
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Menghapus item dari keranjang
     */
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)
                   ->where('user_id', Auth::id())
                   ->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'Item tidak ditemukan.');
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
