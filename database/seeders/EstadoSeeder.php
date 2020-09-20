<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoModel;

class EstadoSeeder extends Seeder
{
    
    public function run(EstadoModel $estado)
    {
        $estado->create([
            'uf' => 'AC',
            'estado' => 'Acre'
        ]);
        $estado->create([
            'uf' => 'AL',
            'estado' => 'Alagoas'
        ]);
        $estado->create([
            'uf' => 'AP',
            'estado' => 'Amapá'
        ]);
        $estado->create([
            'uf' => 'AM',
            'estado' => 'Amazonas'
        ]);
        $estado->create([
            'uf' => 'BA',
            'estado' => 'Bahia'
        ]);
        $estado->create([
            'uf' => 'CE',
            'estado' => 'Ceará'
        ]);
        $estado->create([
            'uf' => 'DF',
            'estado' => 'Distrito Federal'
        ]);
        $estado->create([
            'uf' => 'ES',
            'estado' => 'Espírito Santo'
        ]);
        $estado->create([
            'uf' => 'GO',
            'estado' => 'Goiás'
        ]);
        $estado->create([
            'uf' => 'MA',
            'estado' => 'Maranhão'
        ]);
        $estado->create([
            'uf' => 'MT',
            'estado' => 'Mato Grosso'
        ]);
        $estado->create([
            'uf' => 'MS',
            'estado' => 'Mato Grosso do Sul'
        ]);
        $estado->create([
            'uf' => 'MG',
            'estado' => 'Minas Gerais'
        ]);
        $estado->create([
            'uf' => 'PA',
            'estado' => 'Pará'
        ]);
        $estado->create([
            'uf' => 'PB',
            'estado' => 'Paraíba'
        ]);
        $estado->create([
            'uf' => 'PR',
            'estado' => 'Paraná'
        ]);
        $estado->create([
            'uf' => 'PE',
            'estado' => 'Pernambuco'
        ]);
        $estado->create([
            'uf' => 'PI',
            'estado' => 'Piauí'
        ]);
        $estado->create([
            'uf' => 'RJ',
            'estado' => 'Rio de Janeiro'
        ]);
        $estado->create([
            'uf' => 'RN',
            'estado' => 'Rio Grande do Norte'
        ]);
        $estado->create([
            'uf' => 'RS',
            'estado' => 'Rio Grande do Sul'
        ]);
        $estado->create([
            'uf' => 'RO',
            'estado' => 'Rondônia'
        ]);
        $estado->create([
            'uf' => 'RR',
            'estado' => 'Roraima'
        ]);
        $estado->create([
            'uf' => 'SC',
            'estado' => 'Santa Catarina'
        ]);
        $estado->create([
            'uf' => 'SP',
            'estado' => 'São Paulo'
        ]);
        $estado->create([
            'uf' => 'SE',
            'estado' => 'Sergipe'
        ]);
        $estado->create([
            'uf' => 'TO',
            'estado' => 'Tocantins'
        ]);
    }
}
