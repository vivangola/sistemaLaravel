<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncionarioModel extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['cpf', 'rg', 'nome', 'sexo', 'telefone', 'email', 'cargo', 'endereco', 'numero', 'bairro', 'cidade', 'estado_uf', 'cep', 'nascimento'];
}
