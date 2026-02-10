<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdooSyncState extends Model
{
    protected $table = 'odoo_sync_states';

    protected $fillable = [
        'model',
        'last_sync_at',
        'total_records_synced',
        'last_batch_count',
        'status',
        'last_error',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'last_sync_at' => 'datetime',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}

