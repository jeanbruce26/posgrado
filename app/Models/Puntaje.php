<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    use HasFactory;

    protected $primaryKey = "puntaje_id";

    protected $table = 'puntaje';
    protected $fillable = [
        'puntaje_id',
        'puntaje_minimo_expediente_maestria',
        'puntaje_maximo_expediente_maestria',
        'puntaje_minimo_entrevista_maestria',
        'puntaje_maximo_entrevista_maestria',
        'puntaje_minimo_final_maestria',
        'puntaje_maximo_final_maestria',
        'puntaje_minimo_expediente_doctorado',
        'puntaje_maximo_expediente_doctorado',
        'puntaje_minimo_entrevista_doctorado',
        'puntaje_maximo_entrevista_doctorado',
        'puntaje_minimo_investigacion_doctorado',
        'puntaje_maximo_investigacion_doctorado',
        'puntaje_minimo_final_doctorado',
        'puntaje_maximo_final_doctorado',
        'puntaje_estado',
    ];

    public $timestamps = false;

}
