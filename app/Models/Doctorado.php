<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctorado extends Model
{
    use HasFactory;

    protected $table = 'doctorado';
    protected $fillable = [
        'id_doc',
        'cod_doc',
        'doctorado',
    ];
}
