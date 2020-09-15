<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $usuario)
    {
        $usuario->create([
            'username' => 'master',
            'password' => bcrypt('master'),
            'tipo' => 1,
            'fk_status' => 1,
            'fk_funcionario' => 1
        ]);
    }
}
