<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $primaryKey = "id_programa";

    protected $table = 'programa';
    protected $fillable = [
        'id_programa',
        'descripcion_programa',
    ];
    
    public $timestamps = false;
}
