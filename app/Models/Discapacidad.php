<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    protected $table = 'discapacidad';
    protected $fillable = [
        'cod_dist',
        'discapacidad',
 
    ];
}
