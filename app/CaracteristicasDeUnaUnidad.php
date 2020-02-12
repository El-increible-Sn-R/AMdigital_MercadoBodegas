<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CaracteristicasDeUnaUnidad extends Model
{
    protected $table='t_caracteriticas_de_unidades';
    public $timestamps = false;  
    protected $primaryKey = 'caracteristicasUnidad_id';
}
