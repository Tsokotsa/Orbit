<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rfo_timelines', function (Blueprint $table) {

            $table->id();

            $table->foreignId('rfo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('timeline_time');

            $table->text('timeline_action');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rfo_timelines');
    }
};