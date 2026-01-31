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
        Schema::create('starlink_devices', function (Blueprint $table) {
            $table->id();
            $table->string('service_line_number')->index();
            $table->string('device_id')->unique();
            $table->string('device_type');
            $table->string('kit_serial')->nullable();
            $table->string('dish_serial')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_devices');
    }
};
