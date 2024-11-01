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
                $table->decimal('currency_adjustment', 15, 2)->comment('Currency Adjustment');
                $table->decimal('premium_rate', 15, 2)->comment('Premium Rate');
                $table->decimal('general_escalation', 15, 2)->comment('General Escalation');
                $table->decimal('rate_actual_hrm_lcm', 15, 2)->comment('Rate Actual HRM LCM (Rp/ton/KM)');
                $table->string('contract_reference')->comment('Contract Reference');
                $table->timestamps(); // created_at and updated_at
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