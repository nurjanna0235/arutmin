<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('value_daywork', function (Blueprint $table) {
            $table->id('id_value');
            $table->bigInteger('id_item')->unsigned();
            $table->string('base_rate_exc')->nullable();
            $table->string('actual_rate_exc')->nullable();
            $table->string('fbr')->nullable();
            $table->timestamps();

            $table->foreign('id_item')->references('id_item')->on('item_daywork')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('value_daywork');
    }
};
