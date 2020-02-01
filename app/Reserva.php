<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Unidad;

class Reserva extends Model
{
    protected $table='t_reservas'; 
    
    public $timestamps = false;
    
    protected $primaryKey = 'reserva_id';
    
    protected $fillable=['reserva_nombre',
        'reserva_apellido',
        'reserva_email',
        'reserva_telefono',
        'reserva_fechaMudanza',
        'reserva_estaBorrado',
        'unidad_id',
        'reserva_codigo',
        'reserva_token_edition'
    ];
    
//    public function UnidadReserva(){
//        return $this->hasMany(UnidadReserva::class,'reserva_id','reserva_id');
//    }
    public function Unidad(){
        //nombreModelo//campo fk en tu tabla//id de la tabla fk
        return $this->belongsTo(Unidad::class,'unidad_id','unidad_id');
        //SQL: select * from `t_unidades` where `t_unidades`.`reserva_id` = 2 limit 1)
    }
    
}
