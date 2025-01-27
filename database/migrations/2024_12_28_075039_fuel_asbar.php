<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('fuel_asbar', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('item'); 
            $table->string('activity'); 
            $table->string('fuel_index')->nullable(); 
            $table->string('distance')->nullable(); 
            $table->string('contract_reference')->unique(); // Referensi kontrak
            $table->date('created_at')->nullable(); // Menggunakan tipe DATE
            $table->date('updated_at')->nullable(); // Menggunakan tipe DATE
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('fuel_asbar');
    }
};
