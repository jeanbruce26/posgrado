<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';
    protected $fillable = [
        'cod_pago',
        'tipo_pago_cod_tipo_pago',
        'concep_pago_cod_concep_pago',
        'monto',
        'fecha_pago',
        'dni',
    ];
    
}
