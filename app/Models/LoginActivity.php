<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'login_activities';

    // Daftar kolom yang BOLEH diisi oleh AuthController
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'role',
        'login_at',
    ];

    // Relasi: Setiap log aktivitas milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}