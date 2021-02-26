<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensalidadeModelsTable extends Migration
{
    
    public function up()
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('plano_id')->constrained()->onDelete('cascade')->onUpdate('cascade');            
            $table->double('valor',8,2);
            $table->string('periodo');
            $table->date('data_pagamento')->nullable();
            $table->foreignId('formas_pagamento_id')->constrained('formas_pagamento')->onDelete('cascade')->onUpdate('cascade');       
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mensalidades');
    }
}
