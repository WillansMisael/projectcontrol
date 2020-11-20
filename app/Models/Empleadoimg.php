<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleadoimg extends Model
{
    //use HasFactory;
    protected $fillable = [
    'nombre', 'apellido', 'ci' ,'estado','imag'
    ];
    public $timestamps = false;
}
