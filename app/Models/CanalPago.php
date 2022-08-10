<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanalPago extends Model
{
    use HasFactory;

    protected $primaryKey = "canal_pago_id";

    protected $table = 'canal_pago';
    protected $fillable = [
        'canal_pago_id',
        'descripcion',
    ];

    public $timestamps = false;
}
