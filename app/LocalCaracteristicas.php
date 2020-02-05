<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class LocalCaracteristicas extends Model
{
    protected $table='t_pivot_local_caracteriticas';
    public $timestamps = false;  
    protected $primaryKey = 'localCaracteristicas_id';
}
