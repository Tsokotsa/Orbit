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
        Schema::create('starlink_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();      // account1, account2, etc.
            $table->string('client_id');
            $table->string('client_secret');                    // optionally encrypted
            $table->enum("active", ["y", "n"])->default("y");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starlink_accounts');
    }
};
