<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbigeoPersona extends Model
{
    protected $primaryKey = "cod_ubi_pers";

    protected $table = 'ubi_pers';
    protected $fillable = [
        'cod_ubi_pers',
        'id_distrito',
        'tipo_ubigeo_cod_tipo',
        'persona_idpersona',
    ];
    
    public $timestamps = false;
}
