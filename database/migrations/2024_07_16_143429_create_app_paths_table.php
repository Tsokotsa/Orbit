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
        Schema::create('app_paths', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('storage_path');
            $table->string('description');
            $table->enum('enabled', ['y','n'])->default('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_paths');
    }
};
