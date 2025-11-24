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
        Schema::table('transactions', function (Blueprint $table) {
            // Tambah kolom catatan
            $table->text('catatan')->nullable()->after('bukti_transfer');
        });
        
        // Update enum status_pembayaran
        \DB::statement("ALTER TABLE transactions MODIFY COLUMN status_pembayaran ENUM('pending', 'lunas', 'ditolak') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
        
        // Rollback enum
        \DB::statement("ALTER TABLE transactions MODIFY COLUMN status_pembayaran ENUM('pending', 'success', 'failed') DEFAULT 'pending'");
    }
};
