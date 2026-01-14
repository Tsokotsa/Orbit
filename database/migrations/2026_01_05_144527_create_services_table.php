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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('d_speed')->nullable();
            $table->string('u_speed')->nullable();
            $table->string('profile')->nullable();
            $table->json('pops')->nullable();
            $table->json('mediums')->nullable();
            $table->enum('public_ip', ['y','n'])->default('n');
            $table->enum('active', ['y','n'])->default('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
