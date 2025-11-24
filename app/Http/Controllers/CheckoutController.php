<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout
     */
    public function index(Request $request)
    {
        // Ambil selected products dari query parameter
        $selectedIds = $request->input('selected_products', []);
        
        if (empty($selectedIds)) {
            return redirect()->route('cart')->with('error', 'Silakan pilih produk yang ingin dibeli.');
        }

        // Ambil cart items yang dipilih
        $selectedCarts = Cart::whereIn('id', $selectedIds)
                            ->where('user_id', Auth::id())
                            ->with('product')
                            ->get();

        if ($selectedCarts->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Produk tidak ditemukan.');
        }

        // Hitung total harga
        $totalHarga = $selectedCarts->sum(function($cart) {
            return $cart->product->harga;
        });

        return view('user.checkout', compact('selectedCarts', 'totalHarga'));
    }

    /**
     * Proses checkout dan simpan transaksi
     */
    public function process(Request $request)
    {
        // Validasi
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cart_ids' => 'required|string',
            'catatan' => 'nullable|string|max:500',
        ], [
            'bukti_transfer.required' => 'Bukti transfer wajib diupload.',
            'bukti_transfer.image' => 'File harus berupa gambar.',
            'bukti_transfer.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'bukti_transfer.max' => 'Ukuran file maksimal 2MB.',
        ]);

        // Parse cart IDs
        $cartIds = explode(',', $request->cart_ids);
        
        // Ambil cart items
        $carts = Cart::whereIn('id', $cartIds)
                    ->where('user_id', Auth::id())
                    ->with('product')
                    ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong.');
        }

        // Upload bukti transfer
        $buktiPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = 'bukti_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $buktiPath = $file->storeAs('bukti_transfer', $filename, 'public');
        }

        DB::beginTransaction();
        try {
            // Buat transaksi untuk setiap produk
            foreach ($carts as $cart) {
                Transaction::create([
                    'user_id' => Auth::id(),
                    'product_id' => $cart->product_id,
                    'total_price' => $cart->product->harga,
                    'metode_pembayaran' => 'Transfer Bank',
                    'status_pembayaran' => 'pending',
                    'bukti_transfer' => $buktiPath,
                    'catatan' => $request->catatan,
                    'tanggal_transaksi' => now(),
                ]);

                // Update status produk
                $cart->product->update(['status' => 'pending_checkout']);
            }

            // Hapus items dari keranjang
            Cart::whereIn('id', $cartIds)
                ->where('user_id', Auth::id())
                ->delete();

            DB::commit();

            return redirect()->route('history')->with('success', 'Pembayaran berhasil diajukan. Menunggu verifikasi admin.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Hapus file jika ada error
            if ($buktiPath && Storage::disk('public')->exists($buktiPath)) {
                Storage::disk('public')->delete($buktiPath);
            }

            // Log error untuk debugging
            \Log::error('Checkout Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'cart_ids' => $cartIds ?? [],
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
