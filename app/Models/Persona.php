<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $primaryKey = "idpersona";

    protected $table = 'persona';
    protected $fillable = [
        'idpersona',
        'num_doc',
        'apell_pater',
        'apell_mater',
        'nombres',
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
        'id_tipo_doc','tipo_doc_cod_tipo');
    }
}
