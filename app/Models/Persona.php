<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $primaryKey = 'idpersona';

    protected $table = 'persona';
    protected $fillable = [
        'idpersona',
        'num_doc',
        'apell_pater',
        'apell_mater',
        'nombres',
        'nombre_completo',
        'direccion',
        'celular1',
        'celular2',
        'sexo',
        'fecha_naci',
        'email',
        'email2',
        'año_egreso',
        'centro_trab',
        'tipo_doc_cod_tipo',
        'discapacidad_cod_disc',
        'est_civil_cod_est',
        'univer_cod_uni',
        'id_grado_academico',
        'especialidad',
        'pais_extra',
    ];

    public $timestamps = false;

    public function TipoDocumento(){
        return $this->belongsTo(TipoDocumento::class,
        'tipo_doc_cod_tipo','id_tipo_doc');
    }

    public function EstadoCivil(){
        return $this->belongsTo(EstadoCivil::class,
        'est_civil_cod_est','cod_est');
    }

    public function Universidad(){
        return $this->belongsTo(Universidad::class,
        'univer_cod_uni','cod_uni');
    }
    
    public function Discapacidad(){
        return $this->belongsTo(Discapacidad::class,
        'discapacidad_cod_disc','cod_disc');
    }

    public function GradoAcademico(){
        return $this->belongsTo(GradoAcademico::class,
        'id_grado_academico','id_grado_academico');
    }

}
