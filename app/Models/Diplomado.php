<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplomado extends Model
{
    use HasFactory;

    protected $table = 'diplomado';
    protected $fillable = [
        'id_diplo',
        'cod_diplo',
        'diplomado',
        'id_plan',
    ];
}
