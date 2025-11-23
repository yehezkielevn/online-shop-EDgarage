<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    // Sesuaikan kolom ini dengan database kamu
    protected $fillable = [
        'user_id',
        'product_id',
        'amount',             // Harga Deal / Nominal
        'status_pembayaran',  // pending, success, failed
        'tanggal_transaksi',
        'catatan',
    ];

    // Relasi: Transaksi milik 1 User (Pembeli)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Transaksi memuat 1 Produk (Motor)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}