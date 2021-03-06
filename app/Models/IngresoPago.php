<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoPago extends Model
{
    use HasFactory;

    protected $primaryKey = "cod_ingre";

    protected $table = 'ingre_pago';
    protected $fillable = [
        'cod_ingre',
        'num_opera',
        'monto',
        'fecha',
        'id_inscripcion',
    ];

    public $timestamps = false;

    public function Inscripcion(){
        return $this->belongsTo(Inscripcion::class,
        'id_inscripcion','id_inscripcion');
    }
}
