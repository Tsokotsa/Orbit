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
        Schema::create('starlink_data_usage_notifications', function (Blueprint $table) {
            $table->id();

            $table->string('client_id')->index();
            $table->unsignedBigInteger('service_id')->index();

            // Replace ENUM with numeric threshold
            $table->unsignedTinyInteger('threshold_percent'); // 50, 60, 75

            // limit control
            $table->boolean('is_limited')->default(false);
            $table->unsignedInteger('max_notifications')->nullable();

            // contact
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->string('telegram_id')->nullable();
            $table->string('whatsapp_nr')->nullable();

            // multi-channel (JSON instead of ENUM)
            $table->json('channels')->nullable(); // ["sms","email"]

            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_data_usage_notifications');
    }
};
