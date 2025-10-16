<?php

namespace App\Modules\Inventario\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insumo extends Model
{
    use SoftDeletes;
    protected $table = 'insumos';

    protected $fillable = [
        'name',
        'sucursal_id',
    ];
}