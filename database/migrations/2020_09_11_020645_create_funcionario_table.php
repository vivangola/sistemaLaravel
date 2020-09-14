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
            $table->increments('id');
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
            $table->string('fk_estado')->nullable();
            $table->foreign('fk_estado')->references('uf')->on('estado')->onDelete('cascade')->onUpdate('cascade');
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
