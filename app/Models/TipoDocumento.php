<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
  protected $table = 'tipo_doc';
    protected $fillable = [
        'id_tipo_doc',
        'doc',
 
    ];
}
