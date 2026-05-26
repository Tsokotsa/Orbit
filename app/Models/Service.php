<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'description',
        'table_identifier',
        'd_speed',
        'u_speed',
        'profile',
        'icon',
        'logo',
        'pops',
        'mediums',
        'public_ip',
        'active',
        'can_top_up',
        'top_up_period',
        'is_prepaid',
        'price',
        'amount_locked',
        'details',

    ];

    protected $casts = [

        'pops' => 'array',
        'mediums' => 'array',

    ];
}
