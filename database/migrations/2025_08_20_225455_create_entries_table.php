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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->nullable()->constrained('agents');
            $table->string('rl_no')->nullable();
            $table->string('country')->nullable();
            $table->foreignId('client_id')->nullable()->constrained('users');
            $table->string('profession')->nullable();
            $table->string('office_visa')->nullable();
            $table->string('processing')->nullable();
            $table->string('sponsor_no')->nullable();
            $table->string('pc_ref_no')->nullable();
            $table->string('medical_report')->nullable();
            $table->string('gcc_medical_report')->nullable();
            $table->longText('note')->nullable();
            $table->enum('status', ['PENDING', 'EMBASSY', 'MANPOWER', 'DELIVERED'])->default('PENDING');
            $table->string('visa_no')->nullable();
            $table->string('id_no')->nullable();
            $table->string('wakala_date')->nullable();
            $table->string('mofa_no')->nullable();
            $table->string('tasheer_finger_date')->nullable();
            $table->string('visa_issued_date')->nullable();
            $table->string('finger_ttc_note')->nullable();
            $table->string('manpower_date')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('is_returned')->nullable();
            $table->longText('return_cause')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
