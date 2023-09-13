<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        Marca::create([
            'nombre' =>'Colorin',
            'descripcion' => 'Se dedicada a la fabricación de equipamiento deportivo y productos de moda.',
        ]);
        Marca::create([
            'nombre' =>'Cetol',
            'descripcion' => 'dedicada al diseño, desarrollo, fabricación y comercialización de equipamiento deportivo',
        ]);
        Marca::create([
            'nombre' =>'Plavicon',
            'descripcion' => 'creación y desarrollo de productos de calidad',
        ]);
        Marca::create([
            'nombre' =>'Danzke',
            'descripcion' => 'es una casa de modas francesa, fundada en París',
        ]);
    }
}
