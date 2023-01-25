<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculaPago extends Model
{
    use HasFactory;

    protected $table = 'matricula_pago';
    protected $primaryKey = 'matricula_pago_id';
    protected $fillable = [
        'matricula_pago_id',
        'pago_id',
        'admitidos_id',
        'concepto_id'
    ];

    public $timestamps = false;

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'pago_id');
    }

    public function admitidos()
    {
        return $this->belongsTo(Admitidos::class, 'admitidos_id');
    }

    public function concepto()
    {
        return $this->belongsTo(ConceptoPago::class, 'concepto_id');
    }
}
