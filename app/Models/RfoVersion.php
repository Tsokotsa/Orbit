<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfoVersion extends Model
{
    protected $fillable = [

        'rfo_id',
        'version',
        'changed_by',
        'snapshot'
    ];

    protected $casts = [

        'snapshot' => 'array'
    ];

    public function rfo()
    {
        return $this->belongsTo(
            Rfo::class
        );
    }
}