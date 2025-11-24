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
        'total_price',
        'metode_pembayaran',
        'status_pembayaran',  // pending, lunas, ditolak
        'tanggal_transaksi',
        'bukti_transfer',
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