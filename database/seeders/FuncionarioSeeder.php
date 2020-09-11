<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Models\FuncionarioModel;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(FuncionarioModel $funcionario)
    {
        $funcionario->create([
            'cpf' => '99999999999',
            'nome' => 'Master',
            'rg' => '999999999',
            'sexo' => 'M',
            'telefone' => '999999999',
            'email' => 'junior.perez@outlook.com.br',
            'cargo' => 'Desenvolvedor',
            'endereco' => '',
            'numero' => 0,
            'bairro' => '',
            'cidade' => 'Ipaussu',
            'fk_uf' => 'SP',
            'cep' => '18950-000',
            'nascimento' => '1996-10-26'
        ]);
    }
}
