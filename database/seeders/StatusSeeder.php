<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusModel;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(StatusModel $status)
    {
        $status->create([
            'id' => '1',
            'status' => 'Ativo'
        ]);
        $status->create([
            'id' => '0',
            'status' => 'Inativo'
        ]);
        $status->create([
            'id' => '2',
            'status' => 'Em Débito'
        ]);
    }
}
