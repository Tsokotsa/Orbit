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
    ];

    // optional: scope for active accounts
    public function scopeActive($query)
    {
        return $query->where('active', 'y');
    }
}
