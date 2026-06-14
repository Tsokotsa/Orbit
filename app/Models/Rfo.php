<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rfo extends Model
{
    protected $fillable = [

        'rfo_number',
        'title',
        'prepared_by',
        'classification',
        'document_version',

        'status',
        'approval_status',

        'incident_date',
        'detection_time',
        'partial_restore_time',
        'full_restore_time',

        'total_duration_minutes',

        'severity',
        'affected_services',
        'affected_region',

        'root_cause',

        'service_impact',
        'partial_restoration_notes',
        'full_restoration_notes',
        'data_integrity',

        'corrective_actions',

        'apology_statement',

        'contact_name',
        'contact_email',
        'contact_phone',
    ];

    protected $casts = [

        //'incident_date' => 'datetime:Y-m-d H:i:s',
        'incident_date' => 'datetime:Y-m-d H:i',
        'detection_time' => 'datetime:Y-m-d H:i',
        'partial_restore_time' => 'datetime:Y-m-d H:i',
        'full_restore_time' => 'datetime:Y-m-d H:i',


        'affected_services' => 'array',
        'affected_region' => 'array',

    ];

    protected static function booted()
    {
        static::creating(function ($rfo) {

            $today = now()->format('Ymd');

            $sequence =
                self::whereDate('created_at', today())
                    ->count() + 1;

            $rfo->rfo_number =
                'PTM-RFO-' .
                $today .
                '-' .
                str_pad($sequence, 4, '0', STR_PAD_LEFT);
        });
    }
    public function preparer()
    {
        return $this->belongsTo(
            User::class,
            'prepared_by'
        );
    }

    public function timelines()
    {
        return $this->hasMany(RfoTimeline::class, 'rfo_id', 'id');
    }

    public function approvals()
    {
        return $this->hasMany(
            RfoApproval::class
        );
    }

    public function versions()
    {
        return $this->hasMany(
            RfoVersion::class
        );
    }

}