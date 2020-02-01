<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorarioTable extends Migration
{
    public function up()
    {
        Schema::create('t_horario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('horario_id');
            $table->time('horario_horaEntrada');
            $table->time('horario_horaSalida');
            $table->enum('horario_tipo',['o','a']);//horario de oficina//horario de acceso
            $table->bigInteger('local_id')->unsigned();
            $table->string('horario_dia',255);
            
            $table->foreign('local_id')->references('local_id')->on('t_locales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_horario');
    }
}
