<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeveloper extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'developer_id', 'active'];

    public function developer()
    {
        return $this->belongsTo(Developers::class);
    }
}
