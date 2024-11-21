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
            $table->string('clean_coal')->nullable();
            $table->string('loading_and_ripping')->nullable();
            $table->string('coal_hauling')->nullable();
            $table->string('hrm')->nullable();
            $table->string('pit_support')->nullable();
            $table->string('sub_total_base_rate_coal')->nullable();
            $table->string('currency_adjustment')->nullable();
            $table->string('premium_rate')->nullable();
            $table->string('general_escalation')->nullable();
            $table->string('total_rate_coal_actual')->nullable();
            $table->string('contract_reference');
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