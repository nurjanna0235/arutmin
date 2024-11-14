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
            $table->decimal('load_and_haul', 15, 2)->comment('Rp/BCM');
            $table->decimal('drill_and_blast', 15, 2)->nullable()->comment('Rp/BCM');
            $table->decimal('pit_support', 15, 2)->comment('Rp/BCM');
            $table->decimal('pit_lighting', 15, 2)->comment('Rp/BCM');
            $table->decimal('hrm', 15, 2)->comment('Rp/BCM');
            $table->decimal('dump_maintenance', 15, 2)->comment('Rp/BCM');
            $table->decimal('dewatering_sediment', 15, 2)->comment('Rp/BCM');
            $table->decimal('sub_total_base_rate_ob', 15, 2)->comment('Rp/BCM');
            $table->decimal('sr', 15, 2);
            $table->decimal('currency_adjustment', 15, 2);
            $table->decimal('premium_rate', 15, 2);
            $table->decimal('general_escalation', 15, 2);
            $table->decimal('total_rate_ob_actual', 15, 2)->comment('Rp/BCM');
            $table->string('contract_reference', 100);
            $table->timestamps();
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