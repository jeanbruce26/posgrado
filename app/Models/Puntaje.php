<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    use HasFactory;

    protected $primaryKey = "puntaje_id";

    protected $table = 'puntaje';
    protected $fillable = [
        'puntaje_id',
        'puntaje_minimo_expediente',
        'puntaje_minimo_entrevista',
        'puntaje_minimo_final',
        'puntaje_estado',
    ];

    public $timestamps = false;

}
