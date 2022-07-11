<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
   protected $table = 'ubigeo';
    protected $fillable = [
        'cod_ubi',
        'cod_depart',
        'cod_provin',
        'cod_distri',
        'departamento',
        'provincia',
        'distrito',
    ];
}
