<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class haul_road_maintenance_pltu extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'haul_road_maintenance_pltu';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id_haul_road_maintenance_pltu';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['id_kontraktor','base_rate_hrm_pltu','index','premium_rate','general_escalation','actual_rate_hauling_pltu','contract_reference','created_at','updated_at'];
}
