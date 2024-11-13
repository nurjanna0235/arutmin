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
        Schema::create('other', function (Blueprint $table) {
            $table->id();
            $table->decimal('base_rate_hrm_lcm', 15, 2)->comment('Base Rate HRM LCM (Rp/ton/KM)');
            $table->decimal('currency_adjustment', 15, 2)->nullable()->comment('Currency Adjustment');
            $table->decimal('premium_rate', 15, 2)->nullable()->comment('Premium Rate');
            $table->decimal('general_escalation', 5, 2)->nullable()->comment('General Escalation (%)');
            $table->decimal('rate_actual_hrm_lcm', 15, 2)->nullable()->comment('Rate Actual HRM LCM (Rp/ton/KM)');
            $table->string('contract_reference', 100)->nullable()->comment('Contract Reference');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other');
    }
};
