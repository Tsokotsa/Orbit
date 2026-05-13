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
        Schema::table('odoo_partners', function (Blueprint $table) {
            $table->string('acc_reference', 16)
                ->nullable()
                ->after('odoo_id');

            // Unique index (important for integrity)
            $table->unique('acc_reference', 'accounts_acc_reference_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('odoo_partners', function (Blueprint $table) {
            $table->dropUnique('accounts_acc_reference_unique');
            $table->dropColumn('acc_reference');
        });
    }
};
