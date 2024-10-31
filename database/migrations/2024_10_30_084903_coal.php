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
        Schema::create('coal', function (Blueprint $table) {
            $table->id();
            $table->decimal('clean_coal', 15, 2)->comment('Rp/ton');
            $table->decimal('loading_and_ripping', 15, 2)->comment('Rp/ton');
            $table->decimal('coal_hauling', 15, 2)->comment('Coal Hauling @8,463 Km (Rp/ton)');
            $table->decimal('hrm', 15, 2)->comment('HRM @8,463 Km (Rp/ton)');
            $table->decimal('pit_support', 15, 2)->comment('Rp/ton');
            $table->decimal('sub_total_base_rate_coal', 15, 2)->comment('Rp/ton');
            $table->decimal('currency_adjustment', 15, 2)->nullable();
            $table->decimal('premium_rate', 15, 2)->nullable();
            $table->decimal('general_escalation', 15, 2)->nullable();
            $table->decimal('total_rate_coal_actual', 15, 2)->comment('Rp/ton');
            $table->string('contract_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coal');
    }
};