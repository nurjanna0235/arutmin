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
        Schema::create('haul_road_maintenance_pltu', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('contract_reference')->unique(); // Contract Reference
            $table->string('base_rate_hrm'); // Base Rate HRM PLTU (Rp/ton)
            $table->string('currency_adjustment')->default(1.00); // Currency Adjustment
            $table->string('premium_rate')->nullable(); // Premium Rate (nullable for '-')
            $table->string('general_escalation')->default(0.00); // General Escalation (percentage)
            $table->string('actual_rate_hauling'); // Actual Rate Hauling PLTU (Rp/ton)
            $table->timestamps(); // Created at & Updated at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('haul_road_maintenance_pltu');
    }
};