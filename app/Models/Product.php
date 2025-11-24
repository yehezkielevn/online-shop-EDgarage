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
        'status',   // tersedia, pending_checkout, terjual
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

    /**
     * Check if product is in current user's cart
     */
    public function isInCart()
    {
        if (!auth()->check()) {
            return false;
        }
        return \App\Models\Cart::where('user_id', auth()->id())
                               ->where('product_id', $this->id)
                               ->exists();
    }
}