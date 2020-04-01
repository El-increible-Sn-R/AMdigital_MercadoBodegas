<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Local;
use App\User;

class Empresa extends Model
{
	protected $table='t_empresas';
    public $timestamps = false;  
    protected $primaryKey = 'empresa_id';
    protected $fillable=['empresa_nombre',
        'empresa_pais',
        'empresa_region',
        'empresa_provincia',
        'empresa_comuna',
        'empresa_estaBorrado'];

    public function Local(){
        return $this->hasMany(Local::class,'empresa_id','empresa_id');
    }

    public function UsuariosAdministradores(){
        return $this->belongsToMany(User::class,'t_pivot_administracion','empresa_id','usuario_id');
    }
}
    