<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $primaryKey = "cod_tipo_pago";

    protected $table = 'tipo_pago';
    protected $fillable = [
        'cod_tipo_pago',
        'tipo_pago',
    ];

    public $timestamps = false;
}
