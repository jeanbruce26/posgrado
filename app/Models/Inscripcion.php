<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripcion';
    protected $fillable = [
        'id_inscrip',
        'cod_inscripcion',
        'persona_idpersona',
        'estado',
        'admision_cod_admi',
        'id_detalle_programa',
    ];
}
