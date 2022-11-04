<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $primaryKey = "evaluacion_id";

    protected $table = 'evaluacion';
    protected $fillable = [
        'evaluacion_id',
        'nota_expediente',
        'nota_entrevista',
        'nota_final',
        'evaluacion_observacion',
        'evaluacion_estado',
        'puntaje_id',
        'inscripcion_id',
        'fecha_expediente',
        'fecha_entrevista',
    ];

    public $timestamps = false;

    // Puntaje
    public function Puntaje(){
        return $this->belongsTo(Puntaje::class,
        'puntaje_id','puntaje_id');
    }

    // Inscripcion
    public function Inscripcion(){
        return $this->belongsTo(Inscripcion::class,
        'puntaje_id','puntaje_id');
    }
}
