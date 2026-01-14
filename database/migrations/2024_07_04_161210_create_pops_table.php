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
        Schema::create('pops', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("region");
            $table->string("city");
            $table->string("district")->nullable();
            $table->string("address")->nullable();
            $table->string("gps_coord")->nullable();
            $table->string("description")->nullable();
            $table->enum('status', ['Active','Disabled'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pops');
    }
};
