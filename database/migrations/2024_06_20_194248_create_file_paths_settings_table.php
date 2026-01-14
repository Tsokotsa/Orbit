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
        Schema::create('file_paths_settings', function (Blueprint $table) {
            $table->id();
            $table->string("folder_name");
            $table->string("sub_folder_1")->nullable();
            $table->string("sub_folder_2")->nullable();
            $table->string("long_path")->nullable();
            $table->enum('status', ['Enabled', 'Disabled'])->default('Enabled');
            $table->string("description1")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_paths_settings');
    }
};
