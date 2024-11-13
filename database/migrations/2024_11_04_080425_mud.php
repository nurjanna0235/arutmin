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
        Schema::create('mud', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->decimal('mud_removal_load_and_haul', 15, 2)->comment('Mud Removal - Load and Haul (Rp/BCM)'); // Kolom untuk Rp/BCM dengan desimal
            $table->string('currency_adjustment', 10); // Kolom Currency Adjustment (string, sesuaikan panjang sesuai kebutuhan)
            $table->decimal('premium_rate', 15, 2); // Kolom Premium Rate
            $table->decimal('general_escalation', 15, 2); // Kolom General Escalation
            $table->decimal('rate_actual', 15, 2)->comment('Rate Actual (Rp/Ha)'); // Kolom Rate Actual dalam Rp/Ha
            $table->string('contract_reference')->nullable(); // Kolom Contract Reference
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mud');
    }
};
