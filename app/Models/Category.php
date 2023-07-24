<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // una categoría puede tener muchas preguntas
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
