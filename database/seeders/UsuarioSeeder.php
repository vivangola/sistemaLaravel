<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Models\UsuarioModel;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UsuarioModel $usuario)
    {
        $usuario->create([
            'login' => 'master',
            'password' => 'master',
            'tipo' => 1,
            'fk_status' => 1,
            'fk_funcionario' => '99999999999'
        ]);
    }
}
