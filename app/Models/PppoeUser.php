<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\ServiceType;

class PppoeUser extends Model
{
    protected $fillable = [
        'region_id',
        'service_type_id',
        'username',
        'is_active',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function generateUsername(): string
    {
        $region = $this->region->code;
        $domain = $this->serviceType->domain;

        return "{$this->id}-{$region}@{$domain}";
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->username = $user->generateUsername();
            $user->saveQuietly();
        });
    }
}
