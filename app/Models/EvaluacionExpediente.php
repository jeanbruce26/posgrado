<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionExpediente extends Model
{
    use HasFactory;

    protected $primaryKey = "evaluacion_expediente_id";

    protected $table = 'evaluacion_expediente';
    protected $fillable = [
        'evaluacion_expediente_id',
        'evaluacion_expediente_nota',
        'evaluacion_expediente_titulo_id',
        'evaluacion_id',
    ];

    public $timestamps = false;

    // Evaluacion Expediente Titulo
    public function EvaluacionExpedienteTitulo(){
        return $this->belongsTo(EvaluacionExpedienteTitulo::class,
        'evaluacion_expediente_titulo_id','evaluacion_expediente_titulo_id');
    }

    // Evaluacion 
    public function Evaluacion(){
        return $this->belongsTo(Evaluacion::class,
        'evaluacion_id','evaluacion_id');
    }
}
