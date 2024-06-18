<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desafios extends Model
{
    use HasFactory;

    protected $table = 'desafios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'recompensa',
        'dificultad',
    ];
}
