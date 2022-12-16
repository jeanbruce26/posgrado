<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mencion extends Model
{
    use HasFactory;

    protected $primaryKey = "id_mencion";

    protected $table = 'mencion';
    protected $fillable = [
        'id_mencion',
        'cod_mencion',
        'mencion',
        'id_subprograma',
        'id_plan',
        'estado'
    ];

    public $timestamps = false;
    
    public function SubPrograma(){
        return $this->belongsTo(SubPrograma::class,
        'id_subprograma','id_subprograma');
    }

    public function Plan(){
        return $this->belongsTo(Plan::class,
        'id_plan','id_plan');
    }
}
