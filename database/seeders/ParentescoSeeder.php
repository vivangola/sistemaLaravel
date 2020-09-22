<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParentescoModel;

class ParentescoSeeder extends Seeder
{
    public function run(ParentescoModel $parentesco)
    {
        $parentesco->create([
            'parentesco' => 'Filho',
        ]);
        $parentesco->create([
            'parentesco' => 'Filha',
        ]);
        $parentesco->create([
            'parentesco' => 'Mãe',
        ]);
        $parentesco->create([
            'parentesco' => 'Pai',
        ]);
        $parentesco->create([
            'parentesco' => 'Sogra',
        ]);
        $parentesco->create([
            'parentesco' => 'Sogro',
        ]);
    }
}
