<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDesafio extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'desafio_id', 'active', 'complete'];

    public function desafio()
    {
        return $this->belongsTo(Desafios::class);
    }
}
