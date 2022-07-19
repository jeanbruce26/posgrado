<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    
    protected $primaryKey = "id_plan";

    protected $table = 'plan';
    protected $fillable = [
        'id_plan',
        'plan',
    ];

    public $timestamps = false;
}
