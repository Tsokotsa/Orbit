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
        Schema::create('starlink_router_usages', function (Blueprint $table) {
            $table->id();
            $table->string('device_id')->index();
            $table->timestamp('recorded_at')->index();

            // cumulative counters
            $table->unsignedBigInteger('wan_tx_bytes')->nullable();
            $table->unsignedBigInteger('wan_rx_bytes')->nullable();

            // calculated deltas (per 15s)
            $table->unsignedBigInteger('delta_tx_bytes')->nullable();
            $table->unsignedBigInteger('delta_rx_bytes')->nullable();

            // converted Mbps
            $table->decimal('tx_mbps', 10, 4)->nullable();
            $table->decimal('rx_mbps', 10, 4)->nullable();

            $table->timestamps();

            $table->unique(['device_id', 'recorded_at']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_router_usages');
    }
};
