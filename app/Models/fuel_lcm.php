<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fuel_lcm extends Model
{
    protected $table = 'fuel_lcm';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'activity',
        'item',
        'contractual_distance',
        'fuel_index',
        'id_contract',
        'created_at',
        'updated_at',
        'name_contract',
    ];
}
