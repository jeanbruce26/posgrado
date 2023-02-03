<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Inscripcion extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_inscripcion';

    protected $dates = ['fecha_inscripcion'];

    protected $table = 'inscripcion';
    protected $fillable = [
        'id_inscripcion',
        'inscripcion_codigo',
        'persona_idpersona',
        'estado',
        'admision_cod_admi',
        'id_mencion',
        'inscripcion',
        'fecha_inscripcion',
        'tipo_programa'
    ];

    public $timestamps = false;

    // Persona
    public function Persona(){
        return $this->belongsTo(Persona::class,
        'persona_idpersona','idpersona');
    }

    // Admision
    public function Admision(){
        return $this->belongsTo(Admision::class,
        'admision_cod_admi','cod_admi');
    }

    // Mencion
    public function Mencion(){
        return $this->belongsTo(Mencion::class,
        'id_mencion','id_mencion');
    }

}
