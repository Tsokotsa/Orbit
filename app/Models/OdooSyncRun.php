<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdooSyncRun extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'status',
        'started_at',
        'finished_at',
        'duration_seconds',
        'total_records_synced',
        'last_error',
    ];
}
