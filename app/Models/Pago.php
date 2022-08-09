<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;


    protected $primaryKey = "pago_id";

    protected $table = 'pago';
    protected $fillable = [
        'pago_id', 
        'dni',
        'nro_operacion',
        'monto',
        'fecha_pago',
        'estado',
        'canal_pago_id',
    ];

    public $timestamps = false;

    public function CanalPago(){
        return $this->belongsTo(CanalPago::class,
        'canal_pago_id','canal_pago_id');
    }

}
