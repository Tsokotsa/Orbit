<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class PaymentGateway extends Model
{
    protected $fillable = [
        'compid',
        'prodid',
        'agent',
        'uri',
        'basic_auth',
        'description',
        'status',
        'access_token',
        'refresh_token',
        'token_expires_at',
    ];

    protected $casts = [
        'basic_auth' => 'array',
        'access_token' => 'string',   // latest access token
        'refresh_token' => 'string',  // latest refresh token
        'token_expires_at' => 'datetime',  // access token expiration
    ];
}
