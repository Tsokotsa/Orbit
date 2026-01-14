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
        Schema::create('dashboard_trends', function (Blueprint $table) {
            $table->id();
            $table->integer('sms')->nullable();
            $table->integer('telegram')->nullable();
            $table->integer('emails')->nullable();
            $table->string('details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_trends');
    }
};
