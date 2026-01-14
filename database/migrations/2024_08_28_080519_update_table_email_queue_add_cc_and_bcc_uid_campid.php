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
        Schema::table('email_queue', function (Blueprint $table) {
            $table->string('cc')->after('title')->nullable();
            $table->string('bcc')->after('cc')->nullable();
            $table->integer('uid')->after('queued_from');
            $table->integer('campaign_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_queue', function (Blueprint $table) {
            $table->dropIfExists('cc');
            $table->dropIfExists('bcc');
            $table->dropIfExists('uid');
            $table->dropIfExists('campaign_id');
        });
    }
};
