<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daywork_asbar extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'daywork_asbar';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id_daywork_asbar';

    public $timestamps = false;

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['id_kontraktor','id_item_daywork_asbar','currency_adjustment','index','premium_rate','general_escalation','base_rate_exc_fuel','actual_rate_exc_fuel','contract_reference','created_at','updated_at','name_contract'];
}
