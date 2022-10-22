<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioTrabajador extends Model
{
    use HasFactory;

    protected $primaryKey = "usuario_id";

    protected $table = 'usuario';
    protected $fillable = [
        'usuario_id',
        'usuario_nombre',
        'usuario_contraseña',
        'trabajador_tipo_trabajador_id',
    ];

    public $timestamps = false;

    // Trabajador
    public function TrabajadorTipoTrabajador(){
        return $this->belongsTo(TrabajadorTipoTrabajador::class,
        'trabajador_tipo_trabajador_id','trabajador_tipo_trabajador_id');
    }
}
