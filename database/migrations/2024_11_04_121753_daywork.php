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
        Schema::create('daywork', function (Blueprint $table) {
            $table->id();
            $table->string('item'); // Kolom item dengan tipe string
            $table->decimal('base_rate_exc_fuel', 15, 2); // Kolom Base Rate Exc. Fuel (Rp/hrs) dengan tipe decimal
            $table->decimal('actual_rate_exc_fuel', 15, 2); // Kolom Actual Rate Exc. Fuel (Rp/Hrs) dengan tipe decimal
            $table->decimal('fbr', 8, 2); // Kolom FBR (liter/hrs) dengan tipe decimal
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daywork');
    }
};
