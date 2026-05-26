<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url',
        'icon',
        'description',
        'category',
        'is_active',
        'open_in_new_tab',
        'sort_order',
    ];
}

