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
        Schema::create('command_scheduler', function (Blueprint $table) {
            $table->id();
            $table->string('command_name');
            $table->enum('type', ['minute','daily', 'weekly', 'monthly']);
            $table->enum('day_of_week', ['sundays','mondays','tuesdays','wednesdays','thursdays','fridays','saturdays'])->nullable();
            $table->string('day_of_month')->nullable();
            $table->string('description')->nullable();
            $table->string('frequency')->nullable();
            $table->string('at')->nullable();
            $table->enum('enabled', ['y', 'n'])->default('n');
            $table->enum('status', ['running', 'paused', 'hold'])->default('hold');
            $table->string('next_execution')->nullable();
            $table->string('warnings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('command_scheduler');
    }
};
