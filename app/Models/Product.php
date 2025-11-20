<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_motor',
        'merek',
        'tipe',
        'tahun',
        'warna',
        'harga',
        'kilometer',
        'plat_nomor',
        'status_surat',
        'status_pajak',
        'minus',
        'gambar', // legacy array
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    // Relasi ke tabel product_images
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order');
    }

    // Method yang diperlukan oleh card: mengembalikan array URL gambar
    public function imageUrls()
    {
        $urls = [];

        // Jika sudah pakai tabel product_images
        if ($this->images && count($this->images) > 0) {
            foreach ($this->images as $img) {
                $urls[] = asset('storage/' . $img->path);
            }
            return $urls;
        }

        // Fallback: jika gambar lama masih ada di kolom "gambar"
        if ($this->gambar && is_array($this->gambar)) {
            foreach ($this->gambar as $g) {
                $urls[] = asset('storage/' . $g);
            }
        }

        // Jika masih kosong → kasih placeholder
        if (empty($urls)) {
            $urls[] = asset('images/no-image.png');
        }

        return $urls;
    }
}
