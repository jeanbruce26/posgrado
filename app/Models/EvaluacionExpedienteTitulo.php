<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionExpedienteTitulo extends Model
{
    use HasFactory;

    protected $primaryKey = "evaluacion_expediente_titulo_id";

    protected $table = 'evaluacion_expediente_titulo';
    protected $fillable = [
        'evaluacion_expediente_titulo_id',
        'evaluacion_expediente_titulo',
        'evaluacion_expediente_titulo_puntaje_maximo',
    ];

    public $timestamps = false;

}
