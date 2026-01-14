<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->enum('enable_notification', ['y','n'])->default('y');
            $table->char('cell1', length: 20);
            $table->char('cell2', length: 20)->nullable();
            $table->string('telegram_id')->nullable();
            $table->string('notify_on')->default('all');
            $table->string('linked_locations')->nullable();
            $table->enum('status', ['active','disabled'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
