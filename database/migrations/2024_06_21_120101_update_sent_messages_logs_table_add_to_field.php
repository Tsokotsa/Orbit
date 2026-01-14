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
        Schema::table('sent_messages_logs', function (Blueprint $table) {
            $table->string('sent_to')->after('uid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sent_messages_logs', function (Blueprint $table) {
            $table->dropColumn('sent_to');
        });
    }
};
