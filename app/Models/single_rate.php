<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class single_rate extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'single_rate';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['total_base_rate_ob','total_base_rate_coal','sr','currency_adjustment','premium_rate','general_escalation','total_single_rate_actual','contract_reference','created_at','updated_at'];

}

