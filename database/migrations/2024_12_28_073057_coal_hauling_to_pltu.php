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
        Schema::create('coal_hauling_to_pltu', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('contract_reference')->unique(); // Referensi kontrak
            $table->string('base_rate'); // Base Rate Hauling PLTU
            $table->string('currency_adjustment')->default(1.00); // Currency Adjustment
            $table->string('premium_rate')->nullable(); // Premium Rate
            $table->string('general_escalation')->default(0.00); // General Escalation (percentage)
            $table->string('actual_rate'); // Actual Rate Hauling PLTU
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coal_hauling_to_pltu');
    }
};
