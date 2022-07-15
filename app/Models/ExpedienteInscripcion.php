<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedienteInscripcion extends Model
{
    use HasFactory;

    protected $table = 'ex_insc';
    protected $fillable = [
        'cod_ex_insc',
        'nom_exped',
        'estado',
        'observacion',
        'fecha_entre',
        'expediente_cod_exp',
        'id_inscripcion',
    ];
}
