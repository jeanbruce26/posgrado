<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialInscripcion extends Model
{
    use HasFactory;

    protected $table = 'histo_inscr';
    protected $fillable = [
        'cod_histo',
        'id_inscripcion',
        'admision',
    ];

    public $timestamps = false;

    public function Inscripcion(){
        return $this->belongsTo(Inscripcion::class,
        'id_inscripcion','id_inscripcion');
    }
    
}
