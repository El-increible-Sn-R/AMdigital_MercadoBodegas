<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Local;
use App\CaracteristicasDeUnaUnidad;

class Unidad extends Model
{
    protected $table='t_unidades';
    public $timestamps = false;  
    protected $primaryKey = 'unidad_id';
    //este array tiene las columnas que queremos permitir que puedan ser cargadas masivamente:
    protected $fillable=['unidad_precioMensual',
        'unidad_area',
        'unidad_oferta',
        'local_id',
        'unidad_estaBorrado',
        'unidad_estaDisponible'];
    
    public function Local(){
        //nombreModelo//campo fk en tu tabla//id de la tabla a la ke hace referencia tu fk
        return $this->belongsTo(Local::class,'local_id','local_id');
    }

    public function Caracteristicas(){
    	return $this->belongsToMany(CaracteristicasDeUnaUnidad::class,
    		't_pivot_caracteriticas_unidad','unidad_id','caracteristicasUnidad_id');
    }
}
