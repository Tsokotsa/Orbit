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
        Schema::create('starlink_telemetry_refresh', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['idle', 'run', 'done', 'running', 'failed'])->default('idle');
            $table->string('executed_by')->nullable();
            $table->json('notes')->nullable();
            $table->timestamp('executed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_telemetry_refresh');
    }
};
