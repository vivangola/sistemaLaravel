<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObitoModelsTable extends Migration
{
    
    public function up()
    {
        Schema::create('obitos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('cpf_falecido');
            $table->string('local_falecimento')->nullable();
            $table->dateTime('data_falecimento');
            $table->string('local_velorio')->nullable();
            $table->timestamp('data_velorio')->nullable();
            $table->string('local_enterro')->nullable();
            $table->timestamp('data_enterro')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('obitos');
    }
}
