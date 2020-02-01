<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table='t_horario';   
    public $timestamps = false; 
    protected $primaryKey = 'horario_id';
}
