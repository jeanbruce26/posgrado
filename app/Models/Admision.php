<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admision extends Model
{
    use HasFactory;

    protected $table = 'admision';
    protected $fillable = [
        'cod_admi',
        'admision',
    ];
}
