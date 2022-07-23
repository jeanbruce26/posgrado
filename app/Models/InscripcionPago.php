<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionPago extends Model
{
    use HasFactory;

    protected $primaryKey = "cod_insc_pago";

    protected $table = 'insc_pago';
    protected $fillable = [
        'cod_insc_pago',
        'pago_cod_pago',
        'ingre_pago_cod_ingre',
        'estado_ins',
    ];

    public $timestamps = false;

    public function Pago(){
        return $this->belongsTo(Pago::class,
        'pago_cod_pago','cod_pago');
    }

    public function IngresoPago(){
        return $this->belongsTo(IngresoPago::class,
        'ingre_pago_cod_ingre','cod_ingre');
    }

}
