<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'nama_motor' => 'Honda CBR 150R',
                'merek' => 'Honda',
                'tahun' => 2020,
                'warna' => 'Merah',
                'harga' => 25000000,
                'kilometer' => 15000,
                'plat_nomor' => 'B 1234 XYZ',
                'status_surat' => 'Lengkap',
                'status_pajak' => 'Masih berlaku',
                'minus' => 'Ringan, kondisi sangat baik',
                'gambar' => null,
            ],
            [
                'nama_motor' => 'Yamaha NMAX 155',
                'merek' => 'Yamaha',
                'tahun' => 2021,
                'warna' => 'Hitam',
                'harga' => 28000000,
                'kilometer' => 12000,
                'plat_nomor' => 'B 5678 ABC',
                'status_surat' => 'Lengkap',
                'status_pajak' => 'Masih berlaku',
                'minus' => 'Tidak ada, seperti baru',
                'gambar' => null,
            ],
            [
                'nama_motor' => 'Kawasaki Ninja 250',
                'merek' => 'Kawasaki',
                'tahun' => 2019,
                'warna' => 'Hijau',
                'harga' => 35000000,
                'kilometer' => 20000,
                'plat_nomor' => 'B 9012 DEF',
                'status_surat' => 'Lengkap',
                'status_pajak' => 'Masih berlaku',
                'minus' => 'Ada sedikit goresan di tangki',
                'gambar' => null,
            ],
            [
                'nama_motor' => 'Suzuki GSX 150',
                'merek' => 'Suzuki',
                'tahun' => 2022,
                'warna' => 'Biru',
                'harga' => 27000000,
                'kilometer' => 8000,
                'plat_nomor' => 'B 3456 GHI',
                'status_surat' => 'Lengkap',
                'status_pajak' => 'Masih berlaku',
                'minus' => 'Kondisi sangat baik, servis rutin',
                'gambar' => null,
            ],
            [
                'nama_motor' => 'Honda PCX 160',
                'merek' => 'Honda',
                'tahun' => 2023,
                'warna' => 'Putih',
                'harga' => 32000000,
                'kilometer' => 5000,
                'plat_nomor' => 'B 7890 JKL',
                'status_surat' => 'Lengkap',
                'status_pajak' => 'Masih berlaku',
                'minus' => 'Masih sangat baru, kilometer masih rendah',
                'gambar' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
