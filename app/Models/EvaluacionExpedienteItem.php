<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionExpedienteItem extends Model
{
    use HasFactory;
    
    protected $primaryKey = "";

    protected $table = 'evaluacion_expediente_item';
    protected $fillable = [
        'evaluacion_expediente_item_id',
        'evaluacion_expediente_item',
        'evaluacion_expediente_titulo_id',
    ];

    public $timestamps = false;

    // Evaluacion Expediente Titulo
    public function EvaluacionExpedienteTitulo(){
        return $this->belongsTo(EvaluacionExpedienteTitulo::class,
        'evaluacion_expediente_titulo_id','evaluacion_expediente_titulo_id');
    }
}
