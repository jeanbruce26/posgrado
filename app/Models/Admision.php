<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admision extends Model
{
    use HasFactory;

    protected $primaryKey = "cod_admi";

    protected $table = 'admision';
    protected $fillable = [
        'cod_admi',
        'admision',
        'estado',
        'fecha_fin',
    ];

    public $timestamps = false;
}
