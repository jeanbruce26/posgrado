<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioEvaluacionPrograma extends Model
{
    use HasFactory;

    protected $primaryKey = "usuario_evaluacion_programa_id";

    protected $table = 'usuario_evaluacion_programa';
    protected $fillable = [
        'usuario_evaluacion_programa_id',
        'usuario_evaluacion_programa_cantidad',
        'id_mencion',
        'usuario_evaluacion_id',
        'usuario_evaluacion_programa_estado',
    ];

    public $timestamps = false;

    public function usuario_evaluacion()
    {
        return $this->belongsTo(UsuarioEvaluacion::class, 'usuario_evaluacion_id');
    }
}
