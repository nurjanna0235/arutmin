<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('item_daywork', function (Blueprint $table) {
            $table->id('id_item');
            $table->string('nama_item')->nullable();
            $table->date('created_at')->nullable(); // Menggunakan tipe DATE
            $table->date('updated_at')->nullable(); // Menggunakan tipe DATE
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_daywork');
    }
};
