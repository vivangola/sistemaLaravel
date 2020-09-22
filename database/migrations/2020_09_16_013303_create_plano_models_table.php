<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanoModelsTable extends Migration
{
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('plano');
            $table->double('mensalidade',8,2);
            $table->integer('dependentes');
            $table->integer('carencia');
            $table->foreignId('tipo_status_id')->constrained('tipo_status')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plano');
    }
}
