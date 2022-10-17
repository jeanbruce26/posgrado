<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $primaryKey = "trabajador_id";

    protected $table = 'trabajador';
    protected $fillable = [
        'trabajador_id',
        'trabajador_nombres',
        'trabajador_apellidos',
        'trabajador_numero_documento',
        'trabajador_correo',
        'trabajador_direccion',
        'trabajador_grado',
    ];

    public $timestamps = false;

}
