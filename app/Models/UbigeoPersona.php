<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbigeoPersona extends Model
{
    use HasFactory;
    
    protected $primaryKey = "cod_ubi_pers";

    protected $table = 'ubi_pers';
    protected $fillable = [
        'cod_ubi_pers',
        'id_distrito',
        'tipo_ubigeo_cod_tipo',
        'persona_idpersona',
        'ubigeo',
    ];
    
    public $timestamps = false;

    public function TipoUbigeo(){
        return $this->belongsTo(TipoUbigeo::class,
        'tipo_ubigeo_cod_tipo','cod_tipo');
    }
}
