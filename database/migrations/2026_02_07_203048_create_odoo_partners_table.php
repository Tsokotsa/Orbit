<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('odoo_partners', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Odoo identifiers
            $table->unsignedBigInteger('odoo_id')->unique();
            $table->unsignedBigInteger('parent_odoo_id')->nullable()->index();

            // Classification
            $table->boolean('is_company')->default(false)->index();
            $table->boolean('active')->default(true)->index();
            $table->string('company_type')->nullable();

            // Business flags
            $table->integer('customer_rank')->default(0)->index();
            $table->integer('supplier_rank')->default(0)->index();

            // Identity
            $table->longText('name')->index();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('vat')->nullable()->index();
            $table->string('ref')->nullable()->index();

            // Address
            $table->text('contact_address')->nullable();
            $table->string('street')->nullable();
            $table->longText('street2')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code', 10)->nullable();

            // Commercial / accounting
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('property_product_pricelist')->nullable();

            // Relations (JSON – we don’t query these heavily)
            $table->json('child_ids')->nullable();
            $table->json('invoice_ids')->nullable();
            $table->json('prim_invoices_ids')->nullable();
            $table->json('purchase_line_ids')->nullable();
            $table->json('sale_order_ids')->nullable();
            $table->json('subscription_ids')->nullable();
            $table->json('contract_ids')->nullable();
            $table->json('opportunity_ids')->nullable();

            // Counters
            $table->integer('sale_order_count')->default(0);
            $table->integer('opportunity_count')->default(0);

            // Odoo audit
            $table->json('user_id')->nullable();
            $table->json('create_uid')->nullable();
            $table->json('write_uid')->nullable();
            $table->timestamp('odoo_create_date')->nullable();
            $table->timestamp('odoo_write_date')->nullable()->index();

            // Sync tracking
            $table->string('synchronized_m3ms')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->enum('sync_status', ['pending', 'success', 'failed'])->default('pending');
            $table->text('sync_error')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odoo_partners');
    }
};
