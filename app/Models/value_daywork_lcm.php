<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class value_daywork_lcm extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'value_daywork_lcm';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id_value_daywork_lcm';

    public $timestamps = false;

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable =['id_item_daywork_lcm','id','actual_rate','fbr'];

    public function dayworkLcm(): BelongsTo
    {
        return $this->belongsTo(value_daywork_lcm::class, 'id');
    }
}
