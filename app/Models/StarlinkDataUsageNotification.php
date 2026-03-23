<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use log;
use App\Models\StarlinkNotificationLog;

class StarlinkDataUsageNotification extends Model
{
    protected $fillable = [
        'client_id',
        'service_id',
        'threshold_percent',
        'is_limited',
        'max_notifications',
        'name',
        'surname',
        'mobile_number',
        'email',
        'telegram_id',
        'whatsapp_nr',
        'channels',
        'active'
    ];

    protected $casts = [
        'channels' => 'array',
        'is_limited' => 'boolean',
    ];

    public function logs()
    {
        return $this->hasMany(StarlinkNotificationLog::class, 'notification_id');
    }
}
