<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarlinkAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_id',
        'client_secret',
        'active',
        'account_number',
        'account_name',
        'region_code',
        'is_valid',
        'has_suspension',
        'suspension_payload',
        'raw_payload',
        'last_synced_at',
    ];

    protected $casts = [
        'is_valid' => 'boolean',
        'has_suspension' => 'boolean',
        'suspension_payload' => 'array',
        'raw_payload' => 'array',
        'last_synced_at' => 'datetime',
    ];


    // optional: scope for active accounts
    public function scopeActive($query)
    {
        return $query->where('active', 'y');
    }
}
