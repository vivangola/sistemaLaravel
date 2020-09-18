<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioTable extends Migration
{
    
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->string('nome');
            $table->string('sexo')->nullable();
            $table->string('telefone');
            $table->string('email')->nullable();
            $table->string('cargo')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado_uf')->nullable();
            $table->foreign('estado_uf')->references('uf')->on('estados')->onDelete('cascade')->onUpdate('cascade');
            $table->string('cep')->nullable();
            $table->date('nascimento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario');
    }
}
