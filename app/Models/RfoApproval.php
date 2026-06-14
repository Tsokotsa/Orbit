<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfoApproval extends Model
{
    protected $fillable = [

        'rfo_id',
        'approver_id',
        'status',
        'comments',
        'approved_at'
    ];

    protected $casts = [

        'approved_at' => 'datetime'
    ];

    public function rfo()
    {
        return $this->belongsTo(
            Rfo::class
        );
    }

    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approver_id'
        );
    }
}