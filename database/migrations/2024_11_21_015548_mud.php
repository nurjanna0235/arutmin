<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mud', function (Blueprint $table) {
            $table->id();
            $table->string('mud_removal_load_and_haul')->nullable();
            $table->string('currency_adjustment')->nullable();
            $table->string('premium_rate')->nullable();
            $table->string('general_escalation')->nullable();
            $table->string('rate_actual')->nullable();
            $table->string('contract_reference');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('mud');
    }
};