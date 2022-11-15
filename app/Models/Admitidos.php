<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admitidos extends Model
{
    use HasFactory;

    protected $primaryKey = "admitidos_id";

    protected $table = 'admitidos';
    protected $fillable = [
        'admitidos_id',
        'admitidos_codigo',
        'evaluacion_id',
    ];

    public $timestamps = false;

    // Evaluacion
    public function Evaluacion(){
        return $this->belongsTo(Evaluacion::class,
        'evaluacion_id','evaluacion_id');
    }
}
