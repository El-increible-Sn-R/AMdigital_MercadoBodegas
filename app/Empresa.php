<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Local;

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
        'usuario_id',
        'empresa_estaBorrado'];

    public function Local(){
        return $this->hasMany(Local::class,'empresa_id','empresa_id');
    }
}
