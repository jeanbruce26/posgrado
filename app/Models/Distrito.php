<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $table = 'distrito';
    protected $fillable = [
        'id',
        'distrito',
        'ubigeo',
        'id_provincia',
    ];

    public $timestamps = false;
    
    public function Provincia(){
        return $this->belongsTo(Provincia::class,
        'id_provincia','id');
    }
}
