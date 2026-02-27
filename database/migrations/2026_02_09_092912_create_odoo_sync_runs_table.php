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
        Schema::create('odoo_sync_runs', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->enum('status', ['running', 'idle', 'failed', 'success'])->default('running');
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();
            $table->integer('duration_seconds')->nullable();
            $table->integer('total_records_synced')->default(0);
            $table->text('last_error')->nullable();
            $table->timestamps();

            $table->index(['model', 'created_at']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odoo_sync_runs');
    }
};
