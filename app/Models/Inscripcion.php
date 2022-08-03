<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $primaryKey = "id_inscripcion";

    protected $table = 'inscripcion';
    protected $fillable = [
        'id_inscripcion',
        'persona_idpersona',
        'estado',
        'admision_cod_admi',
        'id_mencion',
    ];

    public $timestamps = false;

    public function Persona(){
        return $this->belongsTo(Persona::class,
        'persona_idpersona','idpersona');
    }

    public function Admision(){
        return $this->belongsTo(Admision::class,
        'admision_cod_admi','cod_admi');
    }

    public function Mencion(){
        return $this->belongsTo(Mencion::class,
        'id_mencion','id_mencion');
    }

}
