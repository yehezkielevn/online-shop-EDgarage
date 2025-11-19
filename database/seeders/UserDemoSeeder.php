<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDemoSeeder extends Seeder
{
	public function run(): void
	{
		// User non-admin demo
		User::updateOrCreate(
			['email' => 'user@edgarage.com'],
			[
				'name' => 'User E&DGarage',
				'password' => Hash::make('user12345'),
				'is_admin' => false,
				'nomor_hp' => '089876543210',
				'alamat' => 'Jl. Pelanggan Motor No. 45, Bandung',
			]
		);
	}
}


