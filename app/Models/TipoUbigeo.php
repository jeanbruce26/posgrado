<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUbigeo extends Model
{
    protected $table = 'tipo_ubigeo';
    protected $fillable = [
        'cod_tipo',
        'tipo_ubigeo',
 
    ];
}
