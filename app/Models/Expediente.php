<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $primaryKey = "cod_exp";

    protected $table = 'expediente';
    protected $fillable = [
        'cod_exp',
        'tipo_doc',
        'complemento',
        'estado',
    ];

    public $timestamps = false;

}
