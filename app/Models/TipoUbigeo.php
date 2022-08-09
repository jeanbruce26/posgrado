<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUbigeo extends Model
{
    protected $primaryKey = "cod_tipo";

    protected $table = 'tipo_ubigeo';
    protected $fillable = [
        'cod_tipo',
        'tipo_ubigeo',
    ];

    public $timestamps = false;
}
