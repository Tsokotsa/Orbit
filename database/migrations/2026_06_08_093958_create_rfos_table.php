<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rfos', function (Blueprint $table) {

            $table->id();

            $table->string('rfo_number')->unique();

            $table->string('title');

            $table->uuid('approval_token')->nullable()->unique();
            $table->timestamp('approval_token_expires_at')->nullable();

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

            $table->text('rejection_reason')->nullable();

            $table->foreignId('prepared_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('classification')->default('internal');

            $table->string('document_version')
                ->default('1.0');

            $table->string('status')
                ->default('draft');

            $table->string('approval_status')
                ->default('pending');

            $table->dateTime('incident_date');

            $table->dateTime('detection_time');

            $table->dateTime('partial_restore_time')
                ->nullable();

            $table->dateTime('full_restore_time')
                ->nullable();

            $table->integer('total_duration_minutes')
                ->nullable();

            $table->enum('severity', [
                'low',
                'medium',
                'high',
                'critical',
                'disaster'
            ]);

            $table->text('affected_services')->nullable();

            $table->string('affected_region')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | RCA
            |--------------------------------------------------------------------------
            */

            $table->longText('root_cause')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | IMPACT
            |--------------------------------------------------------------------------
            */

            $table->longText('service_impact')
                ->nullable();

            $table->longText('partial_restoration_notes')
                ->nullable();

            $table->longText('full_restoration_notes')
                ->nullable();

            $table->longText('data_integrity')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | ACTIONS
            |--------------------------------------------------------------------------
            */

            $table->longText('corrective_actions')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | APOLOGY
            |--------------------------------------------------------------------------
            */

            $table->longText('apology_statement')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | CONTACT
            |--------------------------------------------------------------------------
            */

            $table->string('contact_name')
                ->nullable();

            $table->string('contact_email')
                ->nullable();

            $table->string('contact_phone')
                ->nullable();

            $table->timestamps();

            $table->index('rfo_number');
            $table->index('severity');
            $table->index('status');
            $table->index('approval_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rfos');
    }
};