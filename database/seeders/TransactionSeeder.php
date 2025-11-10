<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Buat beberapa user dummy jika belum ada
        $users = User::where('is_admin', false)->get();
        if ($users->isEmpty()) {
            $users = User::factory(3)->create(['is_admin' => false]);
        }

        $products = Product::all();
        if ($products->isEmpty()) {
            return;
        }

        $metodePembayaran = ['Transfer Bank', 'E-Wallet', 'Cashless'];
        $statusPembayaran = ['pending', 'success', 'failed'];

        // Buat 3 transaksi
        for ($i = 0; $i < 3; $i++) {
            $user = $users->random();
            $product = $products->random();
            
            Transaction::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'metode_pembayaran' => $metodePembayaran[array_rand($metodePembayaran)],
                'status_pembayaran' => $statusPembayaran[array_rand($statusPembayaran)],
                'tanggal_transaksi' => now()->subDays(rand(1, 7))->format('Y-m-d'),
                'total_price' => $product->harga,
            ]);
        }
    }
}
