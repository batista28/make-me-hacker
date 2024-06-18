<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MejorasObtenidas extends Model
{
    use HasFactory;

    protected $table = 'mejoras_obtenidas';

    protected $fillable = [
        'nombre',
        'tipo',
        'duracion',
        'costo',
    ];
}
