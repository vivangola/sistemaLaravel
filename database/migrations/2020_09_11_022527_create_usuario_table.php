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
            
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('tipo');
            $table->integer('fk_funcionario')->unsigned();
            $table->foreign('fk_funcionario')->references('id')->on('funcionario')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('fk_status');
            $table->foreign('fk_status')->references('cod')->on('tipo_status')->onDelete('cascade')->onUpdate('cascade');
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
