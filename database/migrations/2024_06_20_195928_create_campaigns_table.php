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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->integer("type_id");
            $table->longText("recipients")->nullable();
            $table->enum('preview_to_creator', ['y', 'n'])->nullable();
            $table->string("send_at")->nullable();
            $table->string("repeat_interval")->nullable();
            $table->enum('status', ['Idle','Scheduled', 'Queued','Processed'])->default('Idle');
            $table->string("details")->nullable();
            $table->string("campaign_doc")->nullable();
            $table->integer("created_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
