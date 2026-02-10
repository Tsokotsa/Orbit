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
        Schema::create('odoo_sync_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('last_odoo_id')->nullable()->index();

            // What are we syncing
            $table->string('model')->unique(); // e.g. res.partner

            // Sync cursor
            $table->timestamp('last_sync_at')->nullable();

            // Runtime stats
            $table->unsignedBigInteger('total_records_synced')->default(0);
            $table->unsignedInteger('last_batch_count')->default(0);

            // Status
            $table->enum('status', ['idle', 'running', 'success', 'failed'])->default('idle');
            $table->text('last_error')->nullable();

            // Audit
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odoo_sync_states');
    }
};
