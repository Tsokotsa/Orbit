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
            $table->string('subj')->after('sent_to')->nullable();
            $table->string('result')->after('subj')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sent_messages_logs', function (Blueprint $table) {
            $table->dropColumn('subj');
            $table->dropColumn('result');
        });
    }
};
