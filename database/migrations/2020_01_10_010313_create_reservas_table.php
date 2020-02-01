<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    public function up()
    {
        Schema::create('t_reservas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('reserva_id');
            $table->string('reserva_nombre',255);
            $table->string('reserva_apellido',255);
            $table->string('reserva_email',255);
            $table->bigInteger('reserva_telefono');
            $table->dateTime('reserva_fechaRegistro')->default(date("Y-m-d H:i:s"));
            //aclaracion: sino no se pone a la fecha actual se le suma la ventana de reserva 
            $table->date('reserva_fechaMudanza')->default(date("Y-m-d"))->nullable();
            $table->char('reserva_estado',1)->default('o');
            $table->enum('reserva_estaBorrado',['s','n'])->default('n');
            $table->bigInteger('unidad_id')->unsigned();
            $table->string('reserva_codigo',255);
            $table->string('reserva_token_edition',32);
            
            $table->foreign('unidad_id')->references('unidad_id')->on('t_unidades');
        });
        DB::statement("ALTER TABLE t_reservas ADD CONSTRAINT chk_estado CHECK (reserva_estado in ('o','g','p'));");
    }

    public function down()
    {
        Schema::dropIfExists('t_reservas');
    }
}
