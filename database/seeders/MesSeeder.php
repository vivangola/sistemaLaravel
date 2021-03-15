<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MesModel;

class MesSeeder extends Seeder
{
    public function run(MesModel $meses)
    {
        $meses->create([
            'nome' => 'JANEIRO',
        ]);
        $meses->create([
            'nome' => 'FEVEREIRO',
        ]);
        $meses->create([
            'nome' => 'MARÇO',
        ]);
        $meses->create([
            'nome' => 'ABRIL',
        ]);
        $meses->create([
            'nome' => 'MAIO',
        ]);
        $meses->create([
            'nome' => 'JUNHO',
        ]);
        $meses->create([
            'nome' => 'JULHO',
        ]);
        $meses->create([
            'nome' => 'AGOSTO',
        ]);
        $meses->create([
            'nome' => 'SETEMBRO',
        ]);
        $meses->create([
            'nome' => 'OUTUBRO',
        ]);
        $meses->create([
            'nome' => 'NOVEMBRO',
        ]);
        $meses->create([
            'nome' => 'DEZEMBRO',
        ]);
    }
}
