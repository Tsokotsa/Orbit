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
        Schema::create('starlink_notifications_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('notification_id')->constrained('starlink_data_usage_notifications');

            $table->string('client_id')->index();
            $table->unsignedBigInteger('service_id')->index();

            $table->unsignedTinyInteger('threshold_percent');

            $table->json('processed_data'); // FULL payload sent to user

            $table->enum('status', ['sent', 'error']);

            $table->string('channel'); // sms/email/etc
            $table->string('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_notifications_logs');
    }
};
