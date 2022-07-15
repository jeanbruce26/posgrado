<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbigeoPersona extends Model
{
    protected $table = 'ubi_pers';
    protected $fillable = [
        'cod_ubi_pers',
        'ubigeo_cod_ubi',
        'tipo_ubigeo_cod_tipo',
        'persona_idpersona',
       ];
}
