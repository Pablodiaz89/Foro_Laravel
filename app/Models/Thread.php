<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    // un hilo o pregunta pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // un hilo o pregunta pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // un hilo o pregunta puede tener muchas respuestas
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
