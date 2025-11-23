<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    // 1. Tambah status di produk (agar bisa hilang dari katalog)
    Schema::table('products', function (Blueprint $table) {
        $table->enum('status', ['tersedia', 'terjual'])->default('tersedia'); 
    });

    // 2. Tambah bukti transfer di transaksi
    Schema::table('transactions', function (Blueprint $table) {
        $table->string('bukti_transfer')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
