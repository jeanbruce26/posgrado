<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'est_civil';
    protected $fillable = [
        'cod_est',
        'est_civil',
 
    ];
}
