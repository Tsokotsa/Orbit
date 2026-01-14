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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('short_name');
            $table->string('full_name');
            $table->string('sender')->default('NTT DATA MZ');
            $table->string('src_number');
            $table->string('src_ton');
            $table->string('src_npi');
            $table->string('dst_ton');
            $table->string('dst_npi');
            $table->string('host');
            $table->integer('port')->default('9999');
            $table->integer('timeout');
            $table->string('login');
            $table->string('password');
            $table->enum('status', ['Active', 'Disabled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
