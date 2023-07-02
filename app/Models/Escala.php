<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    use HasFactory;
    protected $table = 'escala';

    public function users()
    {
        return $this->belongsToMany(User::class, 'usuario_escala');
    }
}
