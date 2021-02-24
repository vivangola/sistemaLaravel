<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormasPagamentoModel;

class FormasPagamentoSeeder extends Seeder
{
    
    public function run(FormasPagamentoModel $formasPagamento)
    {
        $formasPagamento->create([
            'descricao' => 'Cartão de Crédito'
        ]);
        $formasPagamento->create([
            'descricao' => 'Cartão de Débito'
        ]);
        $formasPagamento->create([
            'descricao' => 'Dinheiro'
        ]);
    }
}
