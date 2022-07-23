<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;


    protected $primaryKey = "cod_pago";

    protected $table = 'pago';
    protected $fillable = [
        'cod_pago',
        'tipo_pago_cod_tipo_pago',
        'concep_pago_cod_concep',
        'monto',
        'fecha_pago',
        'dni',
    ];

    public $timestamps = false;

    public function tipo_pago(){
        return $this->belongsTo(TipoPago::class,
        'tipo_pago_cod_tipo_pago','cod_tipo_pago');
    }

    public function concep_pago(){
        return $this->belongsTo(ConceptoPago::class,
        'concep_pago_cod_concep','cod_concep');
    }
}
    
