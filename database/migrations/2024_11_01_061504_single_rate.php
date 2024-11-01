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
        Schema::create('single_rate', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_base_rate_ob', 15, 2)->comment('Total Base Rate OB (Rp/BCM)');
            $table->decimal('total_base_rate_coal', 15, 2)->comment('Total Base Rate Coal (Rp/ton)');
            $table->float('sr')->comment('SR');
            $table->decimal('currency_adjustment', 15, 2)->comment('Currency Adjustment');
            $table->decimal('premium_rate', 15, 2)->comment('Premium Rate');
            $table->decimal('general_escalation', 15, 2)->comment('General Escalation');
            $table->decimal('total_single_rate_actual', 15, 2)->comment('Total Single Rate Actual (Rp/ton)');
            $table->string('contract_reference')->comment('Contract Reference');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('single_rate');
    }
};