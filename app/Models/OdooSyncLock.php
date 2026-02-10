<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdooSyncLock extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'status',
        'started_at',
        'last_sync_at',
    ];
}
