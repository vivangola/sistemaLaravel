<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FuncionarioModel;

class FuncionarioSeeder extends Seeder
{
    
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
            'numero' => '',
            'bairro' => '',
            'cidade' => 'Ipaussu',
            'estado_uf' => 'SP',
            'cep' => '18950-000',
            'nascimento' => '1996-10-26'
        ]);
    }
}
