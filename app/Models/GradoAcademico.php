<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoAcademico extends Model
{
    protected $table = 'grado_academico';
    protected $fillable = [
        'id_grado_academico',
        'nom_grado',
    ];
}
