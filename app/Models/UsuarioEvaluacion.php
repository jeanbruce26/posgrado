<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuarioEvaluacion extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = "usuario_evaluacion_id";

    protected $table = 'usuario_evaluacion';
    protected $fillable = [
        'usuario_evaluacion_id',
        'usuario_evaluacion_correo',
        'usuario_evaluacion_password',
        'usuario_evaluacion_estado',
    ];

    public $timestamps = false;
}
