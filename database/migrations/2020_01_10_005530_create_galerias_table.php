<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriasTable extends Migration
{
    public function up()
    {
        Schema::create('t_galeria', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('galeria_id');
            $table->string('galeria_coleccion_orden',255);
            $table->bigInteger('local_id')->unsigned();
            
            $table->foreign('local_id')->references('local_id')->on('t_locales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_galeria');
    }
}
