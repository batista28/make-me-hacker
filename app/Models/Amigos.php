<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigos extends Model
{
    use HasFactory;

    protected $table = 'amigos';

    protected $fillable = [
        'id_usuario',
        'id_amigo',
        'estado_amistad',
        'fecha_solicitud',
        'fecha_aceptacion',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function amigo()
    {
        return $this->belongsTo(User::class, 'id_amigo');
    }
}
