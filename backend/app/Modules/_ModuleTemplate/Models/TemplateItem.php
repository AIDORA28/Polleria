<?php

namespace App\Modules\_ModuleTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateItem extends Model
{
    protected $table = 'template_items';

    protected $fillable = [
        'name',
        'sucursal_id',
    ];
}