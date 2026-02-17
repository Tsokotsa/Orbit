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
        Schema::create('client_service_satt', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('client_id');
            $table->integer('site_id')->nullable();
            $table->string('ip')->nullable();
            $table->string("vlan")->nullable();
            $table->enum('status', ['active', 'suspended', 'disabled', 'other'])->default('active');
            $table->enum('suspension', ['auto', 'mannual', 'force', 'other'])->default('auto');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('vlan_id')->nullable();
            $table->string('connected_port')->nullable();
            $table->string('connected_int')->nullable();
            $table->string('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_service_satt');
    }
};
