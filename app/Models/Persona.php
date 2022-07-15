<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $fillable = [
        'idpersona',
        'num_doc',
        'apell_pater',
        'apell_mater',
        'nombres',
        'direccion',
        'celular1',
        'celular2',
        'sexo',
        'fecha_naci',
        'email',
        'email2',
        'año_egreso',
        'centro_trab',
        'tipo_doc_cod_tipo',
        'discapacidad_cod_disc',
        'est_civil_cod_est',
        'univer_cod_uni',
        'grado_academico_cod_grado',
        'especialidad',
        'pais_extra',

 
    ];
}
