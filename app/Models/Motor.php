<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $table = 'motors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'brand',
        'year',
        'price',
        'image_url',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'year' => 'integer',
        'price' => 'integer',
    ];
}
