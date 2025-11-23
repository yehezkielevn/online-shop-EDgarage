<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nama_motor',
        'merek',
        'tipe',     // KITA GUNAKAN 'tipe' (Standard Indonesia)
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

    public function imageUrls()
    {
        $urls = [];
        if ($this->gambar && is_array($this->gambar)) {
            foreach ($this->gambar as $g) {
                $urls[] = asset('storage/' . $g);
            }
        }
        if (empty($urls)) {
            $urls[] = asset('images/no-image.png');
        }
        return $urls;
    }
}