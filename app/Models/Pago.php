<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pago extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = "pago_id";

    protected $dates = ['fecha_pago'];

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
