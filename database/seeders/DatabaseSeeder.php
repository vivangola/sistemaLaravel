<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadoSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(FuncionarioSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(CategoriaSeeder::class);
    }
}
