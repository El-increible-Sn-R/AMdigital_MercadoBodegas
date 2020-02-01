<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class LocalCaracteristicas extends Model
{
    protected $table='t_localCaracteriticas';
    public $timestamps = false;  
    protected $primaryKey = 'localCaracteristicas_id';
}
