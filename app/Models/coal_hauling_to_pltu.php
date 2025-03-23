<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coal_hauling_to_pltu extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'coal_hauling_to_pltu';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['id_kontraktor','base_rate','currency_ adjustment','premium_rate','general_escalation','actual_rate_hauling_pltu','contract_reference','created_at','updated_at','name_contract'];
}
