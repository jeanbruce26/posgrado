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
    ];

    public $timestamps = false;
    
    public function Mencion(){
        return $this->belongsTo(Mencion::class,
        'id_mencion','id_mencion');
    }

    public function Plan(){
        return $this->belongsTo(Plan::class,
        'id_plan','id_plan');
    }
}
