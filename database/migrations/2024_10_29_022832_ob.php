<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ob', function (Blueprint $table) {
            $table->id();
            $table->string('load_and_haul')->nullable();
            $table->string('drill_and_blast')->nullable();
            $table->string('pit_support')->nullable();
            $table->string('pit_lighting')->nullable();
            $table->string('hrm')->nullable();
            $table->string('dump_maintenance')->nullable();
            $table->string('dewatering_sediment')->nullable();
            $table->string('sub_total_base_rate_ob')->nullable();
            $table->string('sr')->nullable();
            $table->string('currency_adjustment')->nullable();
            $table->string('premium_rate')->nullable();
            $table->string('general_escalation')->nullable();
            $table->string('total_rate_ob_actual')->nullable();
            $table->string('contract_reference');
            $table->date('created_at')->nullable(); // Menggunakan tipe DATE
            $table->date('updated_at')->nullable(); // Menggunakan tipe DATE

        });
    }

      /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ob');
    }
};