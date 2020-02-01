<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Local;

class Unidad extends Model
{
    protected $table='t_unidades';
    protected $primaryKey = 'unidad_id';
    
    public function Local(){
        //nombreModelo//campo fk en tu tabla//id de la tabla a la ke hace referencia tu fk
        return $this->belongsTo(Local::class,'local_id','local_id');
    }
}
