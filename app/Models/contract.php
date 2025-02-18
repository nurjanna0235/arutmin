<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    protected $table = 'contract';

    public $timestamps = true;

    protected $fillable = [
        'id_contact',
        'contract_refren',
        'created_at',
        'updated_at',
    ];
}
