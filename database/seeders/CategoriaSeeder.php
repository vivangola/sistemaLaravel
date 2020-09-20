<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaModel;

class CategoriaSeeder extends Seeder
{
    
    public function run(CategoriaModel $material)
    {
        $material->create([
            'categoria'=> 'Convalescença' 
        ]);
        $material->create([
            'categoria' =>'Decorações' 
        ]);
        $material->create([
            'categoria' => 'Religiosos' 
        ]);
        $material->create([
            'categoria' => 'Urnas' 
        ]);
    }
}
