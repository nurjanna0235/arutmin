<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up(): void
    {
        Schema::create('haul_road_maintenance_pltu', function (Blueprint $table) {
            $table->id();
            $table->string('base_rate')->nullable();
            $table->string('currency_adjustment')->default(1.00);
            $table->string('premium_rate')->nullable();
            $table->string('general_escalation')->default(0.00);
            $table->string('actual_rate_hauling_pltu')->nullable();
            $table->string('contract_reference');
            $table->date('created_at')->nullable(); // Menggunakan tipe DATE
            $table->date('updated_at')->nullable(); // Menggunakan tipe DATE
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('haul_road_maintenance_pltu');
    }
};