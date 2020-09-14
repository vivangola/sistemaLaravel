<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncionarioModel extends Model
{
    protected $table='funcionario';
    protected $fillable = ['cpf', 'rg', 'nome', 'sexo', 'telefone', 'email', 'cargo', 'endereco', 'numero', 'bairro', 'cidade', 'fk_uf', 'cep', 'nascimento'];
}
