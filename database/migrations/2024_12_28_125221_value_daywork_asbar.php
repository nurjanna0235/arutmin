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
        Schema::create('value_daywork_asbar', function (Blueprint $table) {
            $table->id('id_value_daywork_asbar'); // Primary key
            $table->bigInteger('id_item_daywork_asbar')->unsigned(); // fk
            $table->string('actual_rate_exc_fuel'); 
            $table->string('base_rate_exc_fuel'); 
            $table->foreign('id_item_daywork_asbar')->references('id_item_daywork_asbar')->on('item_daywork_asbar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value_daywork_asbar');
    }
};
