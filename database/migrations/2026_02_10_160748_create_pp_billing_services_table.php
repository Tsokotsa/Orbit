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
        Schema::create('pp_billing_services', function (Blueprint $table) {
            $table->id();

            // Who
            $table->unsignedBigInteger('client_id');

            // What service instance
            $table->unsignedBigInteger('service_row_id'); // id in service_fiber / service_wireless
            $table->string('service_table');              // service_fiber, service_wireless
            $table->unsignedBigInteger('service_id');     // reference to services.id

            // When (billing)
            $table->string('billing_period', 7); // YYYY-MM

            // Documents
            $table->boolean('proforma_generated')->default(false);
            $table->timestamp('proforma_generated_at')->nullable();

            $table->boolean('invoice_generated')->default(false);
            $table->timestamp('invoice_generated_at')->nullable();

            // Payment
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'expired'])
                ->default('pending');

            $table->string('payment_reference')->nullable();
            $table->string('gateway_name')->nullable();

            // Financial snapshot
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('MZN');
            $table->enum('amount_locked', ['y', 'n'])->default('y');

            // Lifecycle
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();

            // Indexing & protection
            $table->unique(
                ['service_table', 'service_row_id', 'billing_period'],
                'pp_billing_unique'
            );
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pp_billing_services');
    }
};
