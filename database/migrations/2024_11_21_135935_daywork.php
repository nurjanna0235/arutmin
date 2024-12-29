<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('daywork', function (Blueprint $table) {
            $table->id('id_daywork');
            $table->bigInteger('id_item')->unsigned();
            $table->string('currency_adjustment')->nullable();
            $table->string('premium_rate')->nullable();
            $table->string('general_escalation')->nullable();
            $table->string('contract_reference')->nullable();
            $table->date('created_at')->nullable(); // Menggunakan tipe DATE
            $table->date('updated_at')->nullable(); // Menggunakan tipe DATE
            $table->foreign('id_item')->references('id_item')->on('item_daywork')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daywork');
    }
};
