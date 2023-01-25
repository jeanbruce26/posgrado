<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'curso';
    protected $primaryKey = 'curso_id';
    protected $fillable = [
        'curso_id',
        'curso_codigo',
        'curso_nombre',
        'curso_credito',
        'curso_horas',
        'curso_estado',
        'curso_creacion',
        'ciclo_id',
        'mencion_id',
    ];

    public $timestamps = false;

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }
}
