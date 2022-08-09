<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionPago extends Model
{
    use HasFactory;

    protected $primaryKey = "inscripcion_pago_id";

    protected $table = 'inscripcion_pago';
    protected $fillable = [
        'inscripcion_pago_id',
        'pago_id',
        'inscripcion_id',
        'concepto_pago_id',
    ];

    public $timestamps = false;

    public function Pago(){
        return $this->belongsTo(Pago::class,
        'pago_id','pago_id');
    }

    public function Inscripcion(){
        return $this->belongsTo(Inscripcion::class,
        'inscripcion_id','id_inscripcion');
    }

    public function ConceptoPago(){
        return $this->belongsTo(ConceptoPago::class,
        'concepto_pago_id','concepto_id');
    }

}
