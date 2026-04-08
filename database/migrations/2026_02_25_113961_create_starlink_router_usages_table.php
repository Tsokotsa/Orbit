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

            // Device identifiers
            $table->string('user_terminal_id')->unique();
            $table->string('router_id')->nullable()->index();

            // timestamps
            $table->timestamp('recorded_at')->nullable()->index();
            $table->timestamp('last_seen')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Terminal Telemetry
            |--------------------------------------------------------------------------
            */

            $table->decimal('downlink_mbps', 10, 4)->nullable();
            $table->decimal('uplink_mbps', 10, 4)->nullable();

            $table->decimal('signal_quality', 5, 2)->nullable();
            $table->decimal('obstruction_percent_time', 5, 2)->nullable();
            $table->unsignedInteger('terminal_uptime')->nullable()->index();
            $table->string('terminal_sw')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Latency / Drop Metrics
            |--------------------------------------------------------------------------
            */

            $table->decimal('internet_latency', 10, 4)->nullable();
            $table->decimal('internet_drop', 10, 4)->nullable();

            $table->decimal('pop_latency', 10, 4)->nullable();
            $table->decimal('pop_drop', 10, 4)->nullable();

            $table->decimal('dish_latency', 10, 4)->nullable();
            $table->decimal('dish_drop', 10, 4)->nullable();

            /*
            |--------------------------------------------------------------------------
            | Router Metrics
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('router_uptime')->nullable()->index();
            $table->string('router_sw')->nullable();
            $table->string('router_hw_version')->nullable();
            $table->integer('clients')->nullable();
            $table->integer('clients_2ghz')->nullable();
            $table->integer('clients_5ghz')->nullable();
            $table->integer('clientsEthernet')->nullable();

            // 2.4 GHz rates
            $table->decimal('clients_2ghz_rx_rate_avg', 10, 4)->nullable();
            $table->decimal('clients_2ghz_tx_rate_avg', 10, 4)->nullable();

            // 5 GHz rates
            $table->decimal('clients_5ghz_rx_rate_avg', 10, 4)->nullable();
            $table->decimal('clients_5ghz_tx_rate_avg', 10, 4)->nullable();

            $table->unsignedBigInteger('wan_tx_bytes')->nullable();
            $table->unsignedBigInteger('wan_rx_bytes')->nullable();

            $table->timestamps();

        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_router_usages');
    }
};
