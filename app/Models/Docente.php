<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $primaryKey = "docente_id";

    protected $table = 'docente';
    protected $fillable = [
        'docente_id',
        'trabajador_id',
        'docente_cv',
        'docente_tipo_docente',
    ];

    public $timestamps = false;

    // Trabajador
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class,
        'trabajador_id','trabajador_id');
    }
}
