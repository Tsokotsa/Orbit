<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OdooInvoice extends Model
{
    protected $table = 'odoo_invoices';

    protected $fillable = [
        'odoo_id',
        'partner_odoo_id',
        'partner_name',
        'partner_ref',
        'doc_ref',
        'invoice_date',
        'invoice_date_due',
        'state',
        'currency',
        'amount_total',
        'balance',
        'invoice_code',
        'document_code',
        'odoo_create_u',
        'odoo_write_date',
        'last_synced_at',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'invoice_date_due' => 'date',
        'odoo_write_date' => 'datetime',
        'last_synced_at' => 'datetime',
    ];
}
