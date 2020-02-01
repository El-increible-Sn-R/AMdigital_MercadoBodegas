<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CaracteristicasDeUnLocal extends Model
{
    protected $table='t_caracteriticasLocal';
    public $timestamps = false;  
    protected $primaryKey = 'caracteristicasLocal_id';
}
