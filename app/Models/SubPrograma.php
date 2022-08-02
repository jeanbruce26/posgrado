<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPrograma extends Model
{
    use HasFactory;

    protected $primaryKey = "id_subprograma";

    protected $table = 'subprograma';
    protected $fillable = [
        'id_subprograma',
        'cod_subprograma',
        'subprograma',
        'id_programa',
    ];

    public $timestamps = false;
    
    public function Programa(){
        return $this->belongsTo(Programa::class,
        'id_programa','id_programa');
    }
}
