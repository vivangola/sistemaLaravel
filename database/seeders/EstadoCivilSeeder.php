<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoCivilModel;

class EstadoCivilSeeder extends Seeder
{
    public function run(EstadoCivilModel $civil)
    {
        $civil->create([
            'estado_civil'=> 'Casado(a)' 
        ]);
        $civil->create([
            'estado_civil'=> 'Divorciado(a)' 
        ]);
        $civil->create([
            'estado_civil'=> 'Separado(a)' 
        ]);
        $civil->create([
            'estado_civil'=> 'Solteiro(a)' 
        ]);
        $civil->create([
            'estado_civil'=> 'Viúvo(a)' 
        ]);
    }
}
