<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $primaryKey = "id_inscrip";

    protected $table = 'inscripcion';
    protected $fillable = [
        'id_inscrip',
        'cod_inscripcion',
        'persona_idpersona',
        'estado',
        'admision_cod_admi',
        'id_detalle_programa',
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

    public function DetallePrograma(){
        return $this->belongsTo(DetallePrograma::class,
        'id_detalle_programa','id_detalle_programa');
    }

}
