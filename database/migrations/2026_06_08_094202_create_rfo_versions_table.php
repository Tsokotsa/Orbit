<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rfo_versions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('rfo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('version');

            $table->foreignId('changed_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->longText('snapshot');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rfo_versions');
    }
};