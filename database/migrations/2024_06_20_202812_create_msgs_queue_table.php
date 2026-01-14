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
        Schema::create('msgs_queue', function (Blueprint $table) {
            $table->id();
            $table->string("queued_from")->nullable();
            $table->string("recipient");
            $table->string("title")->nullable();
            $table->longText("content");
            $table->string("schedule")->nullable();
            $table->enum('status', ['Queued','Processing','Processed','Error'])->default('Queued');
            $table->string("details")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msgs_queue');
    }
};
