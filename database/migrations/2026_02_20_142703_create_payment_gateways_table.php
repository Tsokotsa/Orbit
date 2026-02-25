<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('compid');
            $table->string('prodid');
            $table->string('agent')->nullable();
            $table->string('uri');
            $table->string('access_token');
            $table->json('basic_auth');
            $table->string('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('token_expires_at')->nullable(); // for token refresh tracking
            $table->string('refresh_token')->nullable();
            $table->timestamps();
            $table->enum('env', ['dev', 'prod'])->default(value: 'dev');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};
