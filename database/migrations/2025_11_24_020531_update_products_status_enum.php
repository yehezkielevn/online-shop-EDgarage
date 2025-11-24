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
        // Update enum status di products table
        \DB::statement("ALTER TABLE products MODIFY COLUMN status ENUM('tersedia', 'pending_checkout', 'terjual') DEFAULT 'tersedia'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback to previous enum
        \DB::statement("ALTER TABLE products MODIFY COLUMN status ENUM('tersedia', 'terjual') DEFAULT 'tersedia'");
    }
};
