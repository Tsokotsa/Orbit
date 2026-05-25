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
        Schema::create('pppoe_users', function (Blueprint $table) {
            $table->id()->startingValue(100);

            // Client relationship
            $table->integer('client_id')->nullable();

            // Site relationship
            $table->integer('site_id')->nullable();

            // Region relationship
            $table->integer('region_id')->nullable();

            $table->integer('service_type_id')->nullable();

            // PPPoE login
            $table->string('username')->unique()->nullable();

            // Status control
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pppoe_users');
    }
};
