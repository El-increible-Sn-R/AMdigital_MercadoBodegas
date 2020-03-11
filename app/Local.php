<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Unidad;
use App\Horario;
use App\Galeria;
use App\CaracteristicasDeUnLocal;

class Local extends Model
{
    protected $table='t_locales';
    public $timestamps = false;  
    protected $primaryKey = 'local_id';
    protected $fillable=['local_nombre',
        'local_descripcion',
        'empresa_id',
        'local_telefono',
        'local_email',
        'local_pais',
        'local_region',
        'local_provincia',
        'local_comuna',
        'local_direccion',
        'usuario_id',
        'local_latitud',
        'local_longitud',
        'local_nDiasDeReserva',
        'local_estaBorrado'];
    
    public function Unidad(){
        //Este_local->tieneMuchas(UNidades--nombreDelCampofk(deLaTablaUnidad)--nombreDelCampoPKdelLocal)
        return $this->hasMany(Unidad::class,'local_id');
    }
    
    public function Horario(){
        return $this->hasMany(Horario::class,'local_id');
    }
    
    public function Galeria(){
        return $this->hasMany(Galeria::class,'local_id');
    }
    
    public function Caracteristicas(){
    //este local puede tener muchas caracteriticas
    //este local pertenece a muchas Caracteristicas(tabla"CaracteristicasDeUnLocal"+nombreDelATablaPivot+fkDeLaTablaLocal+LaOtraFKdeLaTablaLocal)
        return $this->belongsToMany(CaracteristicasDeUnLocal::class,'t_pivot_local_caracteriticas','local_id','caracteristicasLocal_id');
    }
    



    //intento fallido de usar QueryScope:
    public function scopeName($query, $busqueda){
        //dd("scope: ".$busqueda);
        $query->where('local_pais',$busqueda);
    }
}
