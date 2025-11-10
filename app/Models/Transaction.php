<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_transaksi',
        'total_price',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

