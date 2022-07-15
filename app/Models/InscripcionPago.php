<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionPago extends Model
{
    use HasFactory;

    protected $table = 'insc_pago';
    protected $fillable = [
        'cod_insc_pago',
        'pago_cod_pago',
        'ingre_pago_cod_ingre',
        'estado_ins',
    ];
}
