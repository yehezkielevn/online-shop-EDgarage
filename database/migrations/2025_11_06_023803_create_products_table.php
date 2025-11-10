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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motor');
            $table->string('merek');
            $table->integer('tahun');
            $table->string('warna');
            $table->decimal('harga', 15, 2);
            $table->integer('kilometer');
            $table->string('plat_nomor');
            $table->string('status_surat'); // STNK, BPKB, dll
            $table->string('status_pajak'); // Masih berlaku, Habis
            $table->text('minus')->nullable(); // Keterangan minus motor
            $table->json('gambar')->nullable(); // Array of image paths
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
