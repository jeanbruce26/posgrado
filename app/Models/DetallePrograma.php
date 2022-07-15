<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePrograma extends Model
{
    use HasFactory;

    protected $table = 'detalle_programa';
    protected $fillable = [
        'id_detalle_programa',
        'id_programa',
        'cod_detalle_programa',
        'des_detalle_programa',
        'cod_mencion',
        'cod_descripcion_mencion',
        'id_plan',
        'id_sede',
    ];

    public function Programa(){
        return $this->belongsTo(Programa::class,
        'id_programa','id_programa');
    }

    public function Sede(){
        return $this->belongsTo(Sede::class,
        'id_sede','cod_sede');
    }

    public function Plan(){
        return $this->belongsTo(Plan::class,
        'id_plan','id_plan');
    }
}
