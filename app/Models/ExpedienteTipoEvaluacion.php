<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedienteTipoEvaluacion extends Model
{
    use HasFactory;

    protected $primaryKey = 'expediente_tipo_evaluacion_id';
    protected $table = 'expediente_tipo_evaluacion';
    protected $fillable = [
        'expediente_tipo_evaluacion_id',
        'cod_exp',
        'tipo_expediente_evaluacion',
        'tipo_expediente_evaluacion_estado',
    ];

    public $timestamps = false;

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'cod_exp');
    }
}
