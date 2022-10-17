<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionEntrevistaTitulo extends Model
{
    use HasFactory;

    protected $primaryKey = "evaluacion_entrevista_titulo_id";

    protected $table = 'evaluacion_entrevista_titulo';
    protected $fillable = [
        'evaluacion_entrevista_titulo_id',
        'evaluacion_entrevista_titulo',
    ];

    public $timestamps = false;

}
