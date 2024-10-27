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
        Schema::create('pit_clearing', function (Blueprint $table) {
            $table->id();
            $table->decimal('base_rate', 15, 2); // Kolom untuk base rate dengan 2 angka desimal
            $table->decimal('currency_adjustment', 15, 2); // Kolom untuk currency adjustment dengan 2 angka desimal
            $table->decimal('premium_rate', 15, 2); // Kolom untuk premium rate dengan 2 angka desimal
            $table->decimal('general_escalation', 15, 2); // Kolom untuk general escalation dengan 2 angka desimal
            $table->decimal('rate_actual', 15, 2); // Kolom untuk rate actual (Rp/Ha) dengan 2 angka desimal
            $table->string('contract_reference'); // Kolom untuk contract reference
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pit_clearing');
    }
};
