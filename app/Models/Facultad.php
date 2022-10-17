<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $primaryKey = "facultad_id";

    protected $table = 'facultad';
    protected $fillable = [
        'facultad_id',
        'facultad',
    ];

    public $timestamps = false;

}
