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
        Schema::create('vendor_models', function (Blueprint $table) {
            $table->id();
            $table->integer('v_id')->nullable();
            $table->string('name')->nullable();
            $table->string('des')->nullable();
            $table->string('short_name')->nullable();
            $table->enum('active', ['y', 'n'])->default('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_models');
    }
};
