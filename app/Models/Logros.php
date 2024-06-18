<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logros extends Model
{
    use HasFactory;

    protected $table = 'logros';

    protected $fillable = [
        'nombre',
        'descripcion',
        'puntos',
        'desbloqueado_por',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'desbloqueado_por');
    }
}
