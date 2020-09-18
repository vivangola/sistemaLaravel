<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoStatusTable extends Migration
{
    
    public function up()
    {
        Schema::create('tipo_status', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->primary('id');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_status');
    }
}
