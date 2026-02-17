<?php

// app/Models/PPBillingService.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPBillingService extends Model
{
    protected $table = 'pp_billing_services';

    protected $fillable = [
        'client_id',
        'service_table',
        'service_row_id',
        'service_id',
        'billing_period',
        'amount',
        'currency',
        'payment_status',
        'amount_locked',
    ];
}

