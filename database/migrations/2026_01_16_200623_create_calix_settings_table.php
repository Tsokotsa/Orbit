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
        Schema::create('calix_settings', function (Blueprint $table) {
            $table->id();
            $table->string("region")->nullable();
            $table->json("settings")->nullable();
            $table->enum("active", ['y', 'n'])->default('y');
            $table->string("details")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calix_settings');
    }
};
