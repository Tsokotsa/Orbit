<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarlinkToken extends Model
{
    protected $fillable = [
        'access_token',
        'expires_in',
        'expires_at',
        'response',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'response' => 'array',
    ];
}
