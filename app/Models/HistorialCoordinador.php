<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCoordinador extends Model
{
    use HasFactory;
    
    protected $primaryKey = "historial_coordinador_id";

    protected $table = 'historial_coordinador';
    protected $fillable = [
        'historial_coordinador_id',
        'usuario_id',
        'trabajador_id',
        'historial_descripcion',
        'historial_tabla',
        'historial_usuario_id',
        'historial_fecha',
    ];

    public $timestamps = false;
}
