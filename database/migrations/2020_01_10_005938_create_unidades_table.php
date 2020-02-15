<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    public function up()
    {
        Schema::create('t_unidades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('unidad_id');
            $table->decimal('unidad_precioMensual',9,2);
            $table->Integer('unidad_area');
            $table->string('unidad_oferta',255)->nullable();
            $table->bigInteger('local_id')->unsigned();
            $table->char('unidad_estaBorrado',1)->default('n');
            $table->char('unidad_estaDisponible',1)->default('s');
            
            $table->foreign('local_id')->references('local_id')->on('t_locales');
        });
        DB::statement("ALTER TABLE t_unidades ADD CONSTRAINT chk_estaBorrado check (unidad_estaBorrado in ('s','n'));");
        DB::statement("ALTER TABLE t_unidades ADD CONSTRAINT chk_disponibilidad check (unidad_estaDisponible in ('s','n'))");
    }
    
    public function down()
    {
        Schema::dropIfExists('t_unidades');
    }
}
