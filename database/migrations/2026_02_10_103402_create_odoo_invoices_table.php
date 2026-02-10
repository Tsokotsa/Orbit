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
        Schema::create('odoo_invoices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('odoo_id')->unique();
            $table->unsignedBigInteger('partner_odoo_id')->nullable();

            $table->string('partner_name')->nullable();
            $table->string('partner_ref')->nullable();
            $table->string('doc_ref')->nullable();

            $table->date('invoice_date')->nullable();
            $table->date('invoice_date_due')->nullable();

            $table->string('state')->nullable();
            $table->string('currency', 10)->nullable();
            $table->double('amount_total')->nullable();
            $table->double('balance')->nullable();

            $table->string('invoice_code')->nullable();     // name / number
            $table->string('document_code')->nullable();    // payment_reference or ref

            $table->string('odoo_create_u')->nullable();
            $table->timestamp('odoo_write_date')->nullable();

            $table->timestamp('last_synced_at')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odoo_invoices');
    }
};
