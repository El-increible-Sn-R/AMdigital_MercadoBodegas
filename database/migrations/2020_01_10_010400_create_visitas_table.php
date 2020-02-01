<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration
{
    public function up()
    {
        Schema::create('t_visitas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('visitas_id');
            $table->string('visitas_ip',255);
            $table->dateTime('visitas_fecha')->default(date('Y-m-d'));
            $table->time('visitas_hora')->default(date('H:i:s'));
            $table->bigInteger('local_id')->unsigned();
            
            $table->foreign('local_id')->references('local_id')->on('t_locales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_visitas');
    }
}
