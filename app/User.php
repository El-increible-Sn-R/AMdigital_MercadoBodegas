<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //The attributes that are mass assignable
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    //The attributes that should be hidden for arrays.
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $table='t_usuarios';
    public $timestamps = false;  
    protected $primaryKey = 'usuario_id';    
}
