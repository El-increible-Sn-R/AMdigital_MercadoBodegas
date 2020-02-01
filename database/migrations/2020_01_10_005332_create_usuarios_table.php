<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('t_usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('usuario_id');
            $table->string('usuario_nombre',255);
            $table->string('usuario_apellido',255);
            $table->bigInteger('usuario_telefono')->unsigned();
            $table->string('usuario_login',255);
            $table->string('usuario_contrasenia',255);
            $table->string('usuario_imagen',255)->nullable();
            $table->char('usuario_tipo',1);
        });
        DB::statement("ALTER TABLE t_usuarios ADD CONSTRAINT chk_queTipoEs CHECK (usuario_tipo in ('s','a','e'));");  
    }

    public function down()
    {
        Schema::dropIfExists('t_usuarios');
    }
}
