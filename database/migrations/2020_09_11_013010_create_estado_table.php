<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoTable extends Migration
{
    
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->string('uf');
            $table->primary('uf');
            $table->string('estado');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
