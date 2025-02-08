<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_daywork_lcm extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'item_daywork_lcm';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id_item_daywork_lcm';

    public $timestamps = false;

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['nama_item',];
}
