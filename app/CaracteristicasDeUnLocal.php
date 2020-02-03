<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\GrupoCaracteristicas;

class CaracteristicasDeUnLocal extends Model
{
    protected $table='t_caracteriticasLocal';
    public $timestamps = false;  
    protected $primaryKey = 'caracteristicasLocal_id';

    public function GrupoCaracteristicas(){
    	return $this->belongsTo(GrupoCaracteristicas::class,'grupo_id');
    }
}
