<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pit_clearing_lcm', function (Blueprint $table) {
            $table->id();
            $table->string('rate_actual_base_rate_lebih_dari')->nullable();
            $table->string('rate_actual_base_rate_kurang_dari')->nullable();
            $table->string('contract_reference');
            $table->date('created_at')->nullable(); // Menggunakan tipe DATE
            $table->date('updated_at')->nullable(); // Menggunakan tipe DATE
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pit_clearing_lcm');
    }
};
