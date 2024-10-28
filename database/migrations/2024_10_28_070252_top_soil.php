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
        Schema::create('top_soil', function (Blueprint $table) {
            $table->id();
            $table->decimal('base_rate', 15, 2)->comment('Base Rate (Rp/Ha)');
            $table->string('currency_adjustment')->nullable();
            $table->decimal('premium_rate', 15, 2)->nullable();
            $table->decimal('general_escalation', 15, 2)->nullable();
            $table->decimal('rate_actual', 15, 2)->comment('Rate Actual (Rp/Ha)')->nullable();
            $table->string('contract_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_soil');
    }
};