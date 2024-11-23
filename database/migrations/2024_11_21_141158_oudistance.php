<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oudistance', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key
            $table->string('activity'); // Kolom Activity dengan tipe string
            $table->string('item'); // Kolom Item dengan tipe string
            $table->string('base_rate', 15, 2); // Kolom Base Rate dengan tipe decimal
            $table->string('actual_rate', 15, 2); // Kolom Actual Rate dengan tipe decimal
            $table->string('contractual_distance_km', 8, 2); // Kolom Contractual Distance (KM) dengan tipe decimal
            $table->string('currency_adjustment', 15, 2); // Kolom Currency Adjustment dengan tipe decimal
            $table->string('premium_rate', 15, 2); // Kolom Premium Rate dengan tipe decimal
            $table->string('general_escalation', 15, 2); // Kolom General Escalation dengan tipe decimal
            $table->string('contract_reference'); // Kolom Contract Reference dengan tipe string
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oudistance');
    }
};
