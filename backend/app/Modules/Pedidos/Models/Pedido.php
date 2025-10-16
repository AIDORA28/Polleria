<?php

namespace App\Modules\Pedidos\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'sucursal_id',
        'mesa',
        'items',
        'estado',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}