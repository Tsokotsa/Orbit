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
        Schema::create('bandwidth_profiles', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('download');
            $table->integer('upload');
            $table->longText('service_link')->nullable();
            $table->string('profile')->nullable();
            $table->integer('region')->nullable();
            $table->enum('active', ['y', 'n'])->default('y');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandwidth_profiles');
    }
};
