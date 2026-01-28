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
        Schema::create('starlink_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer("account_id")->nullable();
            $table->text('access_token')->nullable();
            $table->integer('expires_in')->nullable();
            $table->timestamp('expires_at');
            $table->json('response')->nullable();
            $table->enum("is_default", ["y", "n"])->default("n");
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_tokens');
    }
};
