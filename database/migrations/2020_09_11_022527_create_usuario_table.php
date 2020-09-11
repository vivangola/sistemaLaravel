<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            
            $table->string('login')->unique();
            $table->string('password');
            $table->integer('tipo');
            $table->integer('fk_status');
            $table->foreign('fk_status')->references('cod')->on('tipo_status')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fk_funcionario');
            $table->foreign('fk_funcionario')->references('cpf')->on('funcionario')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('usuario');
    }
}
