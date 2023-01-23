<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    protected $table = 'ciclo';
    protected $primaryKey = 'ciclo_id';
    protected $fillable = [
        'ciclo_id',
        'ciclo',
        'ciclo_estado'
    ];

    public $timestamps = false;
}
