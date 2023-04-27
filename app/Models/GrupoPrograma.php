<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoPrograma extends Model
{
    use HasFactory;

    protected $table = 'grupo_programa';
    protected $primaryKey = 'id_grupo_programa';
    protected $fillable = [
        'id_grupo_programa',
        'grupo',
        'grupo_contador',
        'grupo_cantidad',
        'id_mencion',
        'id_admision',
        'grupo_programa_estado'
    ];

    public $timestamps = false;

    public function mencion()
    {
        return $this->belongsTo(Mencion::class, 'id_mencion');
    }

    public function admision()
    {
        return $this->belongsTo(Admision::class, 'id_admision', 'cod_admi');
    }
}
