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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('serial');
            $table->integer('vendor_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('media_type')->nullable();
            $table->string('logo')->nullable();
            $table->string('asset_name');
            $table->string('short_name')->nullable();
            $table->string('description')->nullable();
            $table->string('model')->nullable();
            $table->enum('active', ['y','n'])->default('y');
            $table->integer('integration_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
