<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'type', 'title', 'subtitle', 'price', 'frequency', 'duration', 'features', 'is_popular'
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
    ];
}

