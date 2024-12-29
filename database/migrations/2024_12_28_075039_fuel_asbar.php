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
        Schema::create('fuel_asbar', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('item'); // Item (contoh: Coal CPP - PLTU)
            $table->string('fuel_index')->nullable(); // Fuel Index (liter/ton atau liter/ton/KM)
            $table->string('distance')->nullable(); // Jarak aktual unit 1-4 (KM)
            $table->timestamps(); // Kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_asbar');
    }
};
