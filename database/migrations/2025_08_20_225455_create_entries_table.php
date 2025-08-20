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
            $table->string('rl_no')->default('RL1717');
            $table->string('country')->nullable();
            $table->foreignId('client_id')->nullable()->constrained('users');
            $table->string('kopil_no')->nullable();
            $table->string('pc_ref_no')->nullable();
            $table->string('medical_report')->nullable();
            $table->string('gcc_medical_report')->nullable();
            $table->longText('return_cause')->nullable();
            $table->longText('note')->nullable();
            $table->enum('status', ['PENDING', 'EMBASSY', 'MANPOWER', 'DELIVERED'])->default('PENDING');
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
