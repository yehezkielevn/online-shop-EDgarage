<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_motor',
        'merek',
        'tahun',
        'warna',
        'harga',
        'kilometer',
        'plat_nomor',
        'status_surat',
        'status_pajak',
        'minus',
        'gambar',
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

