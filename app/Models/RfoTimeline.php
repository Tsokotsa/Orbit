<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfoTimeline extends Model
{
    protected $fillable = [

        'rfo_id',
        'timeline_time',
        'timeline_action'
    ];

    protected $casts = [

        'timeline_time' => 'datetime'
    ];

    public function rfo()
    {
        return $this->belongsTo(Rfo::class, 'rfo_id');
    }
}