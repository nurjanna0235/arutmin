<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pit_clearing', function (Blueprint $table) {
            $table->id();
            $table->float('base_rate')->nullable();
            $table->float('currency_adjustment')->nullable();
            $table->float('premium_rate')->nullable();
            $table->float('general_escalation')->nullable();
            $table->float('rate_actual')->nullable();
            $table->string('contract_reference');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pit_clearing');
    }
};
