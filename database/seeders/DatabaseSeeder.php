<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // un usuario con mís datos
        \App\Models\User::factory()->create(['email' => 'admin@app.com']);
        // 9 usuarios aleatorios
        \App\Models\User::factory(9)->create(); 
        // 10 categorías + que en cada categoría tenga 20 preguntas
        \App\Models\Category::factory(10)
            ->hasThreads(20)
            ->create(); 
        // 400 respuestas
        \App\Models\Reply::factory(400)->create(); 
    }
}
