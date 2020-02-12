<?php
namespace App\Http\Controllers;
use App\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    //Mostrar una lista del recurso.
    public function index()
    {
        return Unidad::all();
    }
    //Almacenar un recurso recién creado en almacenamiento
    public function store(Request $request)
    {
        $content = json_decode($request->getContent(),true);
        //parametros json_decode:el string,true:array asociativo
        $POST_precioMensual=null;
        $POST_superficie=null;
        $POST_oferta=null;
        $POST_local_id=null;
        $POST_estaBorrado=null;
        $POST_estaDisponible=null;
        foreach (array_keys($content) as $key) {
            if($key=='reserva_nombre'){
                $POST_nombre=$content['reserva_nombre'];
            }
            if($key=='reserva_apellido'){
                $POST_apellido=$content['reserva_apellido'];
            }    
            if($key=='reserva_telefono'){
                $POST_telefono=$content['reserva_telefono'];
            }
            if($key=='reserva_email'){
                $POST_email=$content['reserva_email'];
            }
            if($key=='reserva_fechaMudanza'){
                $POST_fechaMudanza=$content['reserva_fechaMudanza'];
            }
            if($key=='unidad_id'){
                $POST_unidad=$content['unidad_id'];
            }
        }
        $UnidadCreada=Reserva::create( 
            ['unidad_precioMensual' => $POST_precioMensual , 
             'unidad_area' => $POST_superficie, 
             'unidad_oferta' => $POST_oferta,
             'local_id' => $POST_local_id,
             'unidad_estaBorrado' => $POST_estaBorrado,
             'unidad_estaDisponible' => $POST_estaDisponible]);
    }

    //Mostrar el recurso especificado.
    public function show($id)
    {
        //
    }

    //Actualizar el recurso especificado en el almacenamiento
    public function update(Request $request, $id)
    {
        
    }

    //Eliminar el recurso especificado del almacenamiento.
    public function destroy($id)
    {
        //
    }
}
