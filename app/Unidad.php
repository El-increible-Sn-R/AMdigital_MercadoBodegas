<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Local;
use App\CaracteristicasDeUnaUnidad;

class Unidad extends Model
{
    protected $table='t_unidades';
    protected $primaryKey = 'unidad_id';
    
    public function Local(){
        //nombreModelo//campo fk en tu tabla//id de la tabla a la ke hace referencia tu fk
        return $this->belongsTo(Local::class,'local_id','local_id');
    }

    public function Caracteristicas(){
    	return $this->belongsToMany(CaracteristicasDeUnaUnidad::class,
    		't_pivot_caracteriticas_unidad','unidad_id','caracteristicasUnidad_id');
    }
}
