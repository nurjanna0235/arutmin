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
        Schema::create('daywork_asbar', function (Blueprint $table) {
            $table->id('id_daywork_asbar'); // Primary key
            $table->bigInteger('id_kontraktor')->unsigned();
            $table->string('currency_adjustment')->nullable();
            
            $table->string('index')->nullable();
            $table->string('premium_rate')->nullable();
            $table->string('general_escalation')->nullable();
            $table->string('contract_reference')->nullable();

            $table->foreign('id_kontraktor')->references('id_kontraktor')->on('kontraktor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daywork_asbar');
    }
};
