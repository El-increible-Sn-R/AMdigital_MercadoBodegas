<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    //The attributes that are mass assignable
    protected $fillable = [
        'usuario_nombre', 
        'usuario_apellido', 
        'usuario_telefono',
        'usuario_login',
        'usuario_contrasenia',
        'usuario_tipo'
    ];

    //The attributes that should be hidden for arrays.
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $table='t_usuarios';
    public $timestamps = false;  
    protected $primaryKey = 'usuario_id';    
}
