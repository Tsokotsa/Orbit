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
        Schema::table('users', function (Blueprint $table) {
            $table->char('tel1', length: 20)->after('email')->nullable();
            $table->char('tel2', length: 20)->after('tel1')->nullable();
            $table->string('telegram_id')->after('tel2')->nullable();
            $table->string('whatsapp_id')->after('telegram_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tel1');
            $table->dropColumn('tel2');
            $table->dropColumn('telegram_id');
            $table->dropColumn('whatsapp_id');
        });
    }
};
