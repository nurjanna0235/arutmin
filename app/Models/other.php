<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class other extends Model

{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'other';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['base_rate_hrm_lcm','currency_adjustment','premium_rate','general_escalation','rate_actual_hrm_lcm','contract_reference'];

 
}


