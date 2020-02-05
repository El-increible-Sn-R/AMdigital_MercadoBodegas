<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoCaracteristicas extends Model
{
    protected $table='t_grupo_de_caracteristicas';
    public $timestamps = false;  
    protected $primaryKey = 'grupo_id';
}

//uno para acceder a la reserva que sabes q existe
//el otro es buscar por codigo si esta eliminado "no hay" si existe o duplicado, devolver ese ultimo registro
//el hash del "reserva_token_edition"  se actualisa cada vez que hacen un login. 