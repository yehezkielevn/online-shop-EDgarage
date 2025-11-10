<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin E&DGarage',
            'email' => 'admin@edgarage.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
            'nomor_hp' => '081234567890',
            'alamat' => 'Jl. Raya Motor No. 123, Jakarta',
        ]);
    }
}
