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
        Schema::create('labour_asbar', function (Blueprint $table) {
            $table->id('id_labour_asbar'); // Primary key
            $table->bigInteger('id_daywork_asbar')->unsigned(); // fk
            $table->string('nama_labour_asbar'); 
            $table->foreign('id_daywork_asbar')->references('id_daywork_asbar')->on('daywork_asbar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labour_asbar');
    }
};
