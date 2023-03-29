<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admitidos extends Model
{
    use HasFactory;

    protected $primaryKey = "admitidos_id";

    protected $table = 'admitidos';
    protected $fillable = [
        'admitidos_id',
        'admitidos_codigo',
        'persona_id',
        'evaluacion_id',
        'constancia_codigo',
        'constancia',
        'id_mencion',
        'tipo_programa',
    ];

    public $timestamps = false;

    // Evaluacion
    public function Evaluacion(){
        return $this->belongsTo(Evaluacion::class,
        'evaluacion_id','evaluacion_id');
    }

    // Mencion
    public function Mencion(){
        return $this->belongsTo(Mencion::class,
        'id_mencion','id_mencion');
    }

    // persona
    public function Persona(){
        return $this->belongsTo(Persona::class,
        'persona_id','idpersona');
    }
}
