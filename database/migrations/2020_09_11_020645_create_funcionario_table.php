<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('funcionario', function (Blueprint $table) {
            $table->string('cpf')->unique();
            $table->string('rg');
            $table->string('nome');
            $table->string('sexo');
            $table->string('telefone');
            $table->string('email');
            $table->string('cargo');
            $table->string('endereco');
            $table->integer('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('fk_uf');
            $table->foreign('fk_uf')->references('uf')->on('estado')->onDelete('cascade')->onUpdate('cascade');
            $table->string('cep');
            $table->date('nascimento');
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
