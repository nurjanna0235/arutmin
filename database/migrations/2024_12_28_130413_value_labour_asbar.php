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
        Schema::create('value_labour_asbar', function (Blueprint $table) {
            $table->id('id_value_labour_asbar'); // Primary key
            $table->bigInteger('id_labour_asbar')->unsigned(); // fk
            $table->string('nama_labour_asbar'); 
            $table->string('rp_hrs'); 
            $table->foreign('id_labour_asbar')->references('id_labour_asbar')->on('labour_asbar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value_labour_asbar');
    }
};
