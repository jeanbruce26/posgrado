<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptoPago extends Model
{
    use HasFactory;

    protected $primaryKey = "cod_concep";

    protected $table = 'concep_pago';
    protected $fillable = [
        'cod_concep',
        'concepto',
        'monto',
        'estado',
    ];

    public $timestamps = false;
}
