<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ob extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'ob';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['load_and_haul','drill_and_blast','pit_support','pit_lighting','hrm','dump_maintenance','dewatering_sediment','sub_total_base_rate_ob','sr','currency_adjustment','premium_rate','general_escalation','total_rate_ob_actual','contract_reference'];
}
