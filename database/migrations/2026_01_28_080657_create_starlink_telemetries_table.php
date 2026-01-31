<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('starlink_telemetries', function (Blueprint $table) {
            $table->id();

            // Mapping
            $table->string('service_line_number')->index();
            $table->string('device_id')->index();
            $table->string('device_type', 1)->index(); // u, r, i

            // Time
            $table->timestamp('observed_at')->index();

            // Common metrics (User Terminal focused)
            $table->float('downlink_mbps')->nullable();
            $table->float('uplink_mbps')->nullable();
            $table->float('ping_latency_ms')->nullable();
            $table->float('ping_drop_rate')->nullable();
            $table->integer('uptime_seconds')->nullable();
            $table->integer('signal_quality')->nullable();

            // Alerts
            $table->json('alerts')->nullable();

            // Flexible payload
            $table->json('metrics')->nullable();
            $table->json('raw')->nullable();

            $table->timestamps();

            $table->unique(['device_id', 'observed_at']);
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('starlink_telemetries');
    }
};
