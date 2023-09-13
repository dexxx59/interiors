<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Categoria::create([
            'nombre' =>'Expresionismo',
            'description' => 'Joel@gmail.com',
        ]);
        
        Categoria::create([
            'nombre' =>'Abstracto',
            'description' => 'Joel@gmail.com',
        ]);
        Categoria::create([
            'nombre' =>'Oleo',
            'description' => 'Joel@gmail.com',
        ]);
    }
}
