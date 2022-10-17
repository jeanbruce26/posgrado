<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioTrabajador extends Model
{
    use HasFactory;

    protected $primaryKey = "usuario_id";

    protected $table = 'usuario_trabajador';
    protected $fillable = [
        'usuario_id',
        
        'usuario_nombre',
        'usuario_ncontraseña',
        'trabajador_id',
    ];

    public $timestamps = false;

    // Trabajador
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class,
        'trabajador_id','trabajador_id');
    }
}
