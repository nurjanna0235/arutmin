<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontraktor', function (Blueprint $table) {
            $table->id('id_kontraktor'); // Primary key
            $table->bigInteger('id_pengguna')->unsigned(); // fk
            $table->string('nama_kontraktor')->nullable();
            $table->foreign('id_pengguna')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('kontraktor');
    }
};
