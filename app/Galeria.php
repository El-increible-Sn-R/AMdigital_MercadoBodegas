<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table='t_galeria';
    public $timestamps = false;  
    protected $primaryKey = 'galeria_id';
}
