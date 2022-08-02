<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePrograma extends Model
{
    use HasFactory;

    protected $primaryKey = "id_detalle_programa";

    protected $table = 'detalle_programa';
    protected $fillable = [
        'id_detalle_programa',
        'id_mencion',
        'id_plan',
        'id_sede',
    ];

    public $timestamps = false;
    
    public function Mencion(){
        return $this->belongsTo(Mencion::class,
        'id_mencion','id_mencion');
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
