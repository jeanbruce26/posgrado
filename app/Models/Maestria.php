<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestria extends Model
{
    use HasFactory;

    protected $table = 'maestria';
    protected $fillable = [
        'id_maestria',
        'cod_maestria',
        'maestria',
        'id_mencion',
        'mencion',
        'id_plan',
    ];
}
