<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdooPartner extends Model
{
    protected $table = 'odoo_partners';

    protected $fillable = [
        'odoo_id',
        'parent_odoo_id',
        'name',
        'email',
        'phone',
        'mobile',
        'vat',
        'ref',
        'is_company',
        'company_type',
        'active',
        'customer_rank',
        'supplier_rank',
        'contact_address',
        'street',
        'street2',
        'city',
        'zip',
        'state',
        'country',
        'country_code',
        'currency_id',
        'property_product_pricelist',
        'child_ids',
        'invoice_ids',
        'prim_invoices_ids',
        'purchase_line_ids',
        'sale_order_ids',
        'subscription_ids',
        'contract_ids',
        'opportunity_ids',
        'sale_order_count',
        'opportunity_count',
        'user_id',
        'create_uid',
        'write_uid',
        'odoo_create_date',
        'odoo_write_date',
        'synchronized_m3ms',
        'sync_status',
        'sync_error',
        'last_synced_at',
    ];

    protected $casts = [
        'is_company' => 'boolean',
        'active' => 'boolean',
        'child_ids' => 'array',
        'invoice_ids' => 'array',
        'prim_invoices_ids' => 'array',
        'purchase_line_ids' => 'array',
        'sale_order_ids' => 'array',
        'subscription_ids' => 'array',
        'contract_ids' => 'array',
        'opportunity_ids' => 'array',

        'user_id' => 'array',
        'create_uid' => 'array',
        'write_uid' => 'array',
    ];
}

