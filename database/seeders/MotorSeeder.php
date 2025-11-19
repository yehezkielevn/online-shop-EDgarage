<?php

namespace Database\Seeders;

use App\Models\Motor;
use Illuminate\Database\Seeder;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $samples = [
            ['name' => 'CBR 150R', 'brand' => 'Honda', 'year' => 2020, 'price' => 35000000],
            ['name' => 'Vario 125', 'brand' => 'Honda', 'year' => 2022, 'price' => 22000000],
            ['name' => 'Byson 150', 'brand' => 'Yamaha', 'year' => 2019, 'price' => 33000000],
            ['name' => 'NMAX 155', 'brand' => 'Yamaha', 'year' => 2021, 'price' => 42000000],
            ['name' => 'GSX-R150', 'brand' => 'Suzuki', 'year' => 2020, 'price' => 34000000],
            ['name' => 'Satria F150', 'brand' => 'Suzuki', 'year' => 2018, 'price' => 28000000],
            ['name' => 'Ninja 250', 'brand' => 'Kawasaki', 'year' => 2021, 'price' => 75000000],
            ['name' => 'Z250', 'brand' => 'Kawasaki', 'year' => 2019, 'price' => 68000000],
            ['name' => 'Aerox 155', 'brand' => 'Yamaha', 'year' => 2023, 'price' => 30000000],
            ['name' => 'PCX 160', 'brand' => 'Honda', 'year' => 2023, 'price' => 46000000],
        ];

        foreach ($samples as $i => $row) {
            Motor::create(array_merge($row, [
                'image_url' => 'https://picsum.photos/seed/motor' . ($i+1) . '/800/600'
            ]));
        }
    }
}
