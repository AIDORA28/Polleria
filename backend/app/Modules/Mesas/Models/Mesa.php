<?php

namespace App\Modules\Mesas\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'mesas';

    protected $fillable = [
        'sucursal_id',
        'numero',
        'estado',
    ];
}