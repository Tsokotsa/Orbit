<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('starlink_accounts', function (Blueprint $table) {

            $table->string('account_number')->nullable()->after('client_secret');
            $table->string('account_name')->nullable()->after('account_number');
            $table->string('region_code', 10)->nullable()->after('account_name');

            $table->boolean('is_valid')->default(true)->after('region_code');
            $table->boolean('has_suspension')->default(false)->after('is_valid');

            $table->json('suspension_payload')->nullable()->after('has_suspension');
            $table->json('raw_payload')->nullable()->after('suspension_payload');

            $table->timestamp('last_synced_at')->nullable()->after('raw_payload');

            $table->index('account_number');
            $table->index('region_code');
            $table->index('is_valid');
        });
    }

    public function down(): void
    {
        Schema::table('starlink_accounts', function (Blueprint $table) {

            $table->dropIndex(['account_number']);
            $table->dropIndex(['region_code']);
            $table->dropIndex(['is_valid']);

            $table->dropColumn([
                'account_number',
                'account_name',
                'region_code',
                'is_valid',
                'has_suspension',
                'suspension_payload',
                'raw_payload',
                'last_synced_at',
            ]);
        });
    }
};