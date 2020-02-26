<?php
namespace App\Http\Controllers;
use App\Unidad;
use App\local;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    //Mostrar una lista del recurso.
    public function index()
    {
        $unidades= Unidad::with('caracteristicas')->get();
        foreach ($unidades as $value) {
            foreach ($value->caracteristicas as $value2) {
                $value2->makeHidden(['pivot']);
            }
        }
        return $unidades;
    }
    //Almacenar un recurso recién creado en almacenamiento
    public function store(Request $request)
    {//parametros json_decode:el string,true:array asociativo
        $content = json_decode($request->getContent(),true);
        $seColocaronLosDatosMinimosRequeridos=true;
        $erroresEnListaParaRetornar=array();
        $POST_precioMensual=null;
        $POST_superficie=null;
        $POST_oferta=null;
        $POST_local_id=null;
        $POST_estaBorrado=null;
        $POST_estaDisponible=null;
        $POST_caracteristicas=null;
        $cantidadDeCaracteristicas=0;
        foreach (array_keys($content) as $key) {
            if($key=='unidad_precioMensual'){
                $POST_precioMensual=$content['unidad_precioMensual'];
            }
            if($key=='unidad_area'){
                $POST_superficie=$content['unidad_area'];
            }    
            if($key=='unidad_oferta'){
                $POST_oferta=$content['unidad_oferta'];
            }
            if($key=='local_id'){
                $POST_local_id=$content['local_id'];
            }
            if($key=='unidad_estaBorrado'){
                $POST_estaBorrado=$content['unidad_estaBorrado'];
            }
            if($key=='unidad_estaDisponible'){
                $POST_estaDisponible=$content['unidad_estaDisponible'];
            }
            if($key=='caracteristicas'){
                $POST_caracteristicas=$content['caracteristicas'];
            }
        }
        if(is_null($POST_precioMensual)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado un precio mensual');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_superficie)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado la superficie de la unidad');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_local_id)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado el id del local al que pertenece esta unidad');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }else{
            $SupuestoLocal=local::find($POST_local_id);
            if($SupuestoLocal == null){
                $MensajeParaRetornar=array('mensaje' => 'ingresaste un id de local que no existe');
                array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
                $seColocaronLosDatosMinimosRequeridos=false;
            }
        }
        if(is_null($POST_caracteristicas)){
            $MensajeParaRetornar=array('advertencia' => 'no has ingresado caracteristicas ha esta unidad');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
        } 
        if($seColocaronLosDatosMinimosRequeridos==false){
            $listaParaRetornar['status']='ERROR';
            $listaParaRetornar['items']=$erroresEnListaParaRetornar;
            //array_push($listaParaRetornar ,$MensajeParaRetornar);
            return response()->json($listaParaRetornar);
        }
        $UnidadCreada=Unidad::create( 
            ['unidad_precioMensual' => $POST_precioMensual , 
             'unidad_area' => $POST_superficie, 
             'unidad_oferta' => $POST_oferta,
             'local_id' => $POST_local_id,
             'unidad_estaBorrado' => $POST_estaBorrado,
             'unidad_estaDisponible' => $POST_estaDisponible]);
        $cantidadDeCaracteristicas=count($POST_caracteristicas);
        $contador=0;
        while ( $cantidadDeCaracteristicas > 0) {
            $UnidadCreada->Caracteristicas()->attach(
                ['caracteristicasUnidad_id'=>$POST_caracteristicas[$contador]]);  
                $contador++;  
                $cantidadDeCaracteristicas--;
        }
        return $UnidadCreada;
        //return $POST_caracteristicas;
    }
    //Mostrar el recurso especificado.
    public function show($id)
    {
        $reserva= Unidad::find($id);
        foreach ($reserva->caracteristicas as $value) {
            $value->makeHidden(['pivot']);
        }
        return $reserva;
    }
    //Actualizar el recurso especificado en el almacenamiento
    public function update(Request $request, $id)
    {
        $loQueSeDv = array();
        $ListaParaRetornar = array();
        $unidadParaActualizar = Unidad::find($id);
        if($unidadParaActualizar != null){
            $contenidosDelRequest = json_decode($request->getContent(),true);
            $POST_caracteristicas = null;
            foreach (array_keys($contenidosDelRequest) as $key) {
                if($key=='caracteristicas'){
                    $unidadParaActualizar->Caracteristicas()->detach();
                    $POST_caracteristicas=$contenidosDelRequest['caracteristicas'];
                    $totalDeCambios=count($POST_caracteristicas) ;
                    $contador=0;
                    //return $POST_caracteristicas;
                    while ( $totalDeCambios > 0) {
                        $unidadParaActualizar->Caracteristicas()
                            ->attach($POST_caracteristicas[$contador]); 
                        $contador++;  
                        $totalDeCambios--;
                    }
                }
            } 
            $unidadParaActualizar->update($request->all());
            $loQueSeDv['status']='OK';
            $loQueSeDv['items']=$unidadParaActualizar;
            return response()->json($loQueSeDv);  
        }else{
            $loQueSeDv['status']='ERROR';
            $ListaParaRetornar=array(
                'mensaje' => "no existe una unidad con ese ID");
            $loQueSeDv['items']=$ListaParaRetornar;
            return response()->json($loQueSeDv);
        }
        echo 'saliste del control';
    }
    //Eliminar el recurso especificado del almacenamiento logicamente.
    public function destroy($id)
    {
        $loQueSeDv = array();
        $ListaParaRetornar = array();
        $unidadParaBorrar = Unidad::find($id);      
        if($unidadParaBorrar != null){
            $unidadParaBorrar->unidad_estaBorrado='s';
            $unidadParaBorrar->unidad_estaDisponible='n';
            $unidadParaBorrar->save();
            $loQueSeDv['status']='OK';
            $loQueSeDv['items']=$unidadParaBorrar;
            return response()->json($loQueSeDv);
        }else{
            $loQueSeDv['status']='ERROR';
            $ListaParaRetornar=array(
                'mensaje' => "no existe una unidad con ese ID");
            $loQueSeDv['items']=$ListaParaRetornar;
            return response()->json($loQueSeDv);
        }
        echo 'saliste del control';
    }
}
