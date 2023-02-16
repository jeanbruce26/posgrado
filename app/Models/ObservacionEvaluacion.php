<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservacionEvaluacion extends Model
{
    use HasFactory;

    protected $primaryKey = 'observacion_id';
    protected $table = 'observacion_evaluacion';
    protected $fillable = [
        'observacion_id',
        'observacion',
        'tipo_observacion_evaluacion',
        'fecha_observacion',
        'estado_observacion',
    ];

    public $timestamps = false;

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id');
    }
}
