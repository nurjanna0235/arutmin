<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daywork extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'daywork';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id_daywork';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable =['id_item','currency_adjustment','premium_rate','general_escalation','contract_reference'];
}
