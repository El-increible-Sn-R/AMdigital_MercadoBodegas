<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Local;
use App\Empresa;
use App\User;

use App\Horario;
use Illuminate\Support\Facades\Schema;

class LocalesController extends Controller
{
    public function index()
    {
        //////hacerlo de esta forma oftendras, una {} por cada local: 
        //return Local::with('Unidad.caracteristicas:pivot')->get();//->makeHidden(['unidad']);
        //equivalente a:
        //select `pivot`, `t_pivot_caracteriticas_unidad`.`unidad_id` as `pivot_unidad_id`, `t_pivot_caracteriticas_unidad`.`caracteristicasUnidad_id` as `pivot_caracteristicasUnidad_id` from `t_caracteriticas_de_unidades` inner join `t_pivot_caracteriticas_unidad` on `t_caracteriticas_de_unidades`.`caracteristicasUnidad_id` = `t_pivot_caracteriticas_unidad`.`caracteristicasUnidad_id` where `t_pivot_caracteriticas_unidad`.`unidad_id` in (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27)
        //(agrega esto para quitar 'unidad_id')->makeHidden(['unidad_id']);
        //[
        //  -{}
        //  -{}
        //]
        //////de esta otra forma, igual xD:
        $TodoslosLocales=Local::all();
        foreach ($TodoslosLocales as  $value) {
            foreach ($value->Unidad as $value2) {
                foreach ($value2->caracteristicas as $value3) {
                    $value3->makeHidden(['pivot']);
                }
            }
            $value->Galeria;
        }
        return $TodoslosLocales;
        //[
        //  -{}
        //  -{}
        //]
    }

    public function store(Request $request)
    {
        $content = json_decode($request->getContent(),true);
        $seColocaronLosDatosMinimosRequeridos=true;
        $erroresEnListaParaRetornar=array();
        $POST_nombre=null;
        $POST_descripcion=null;
        $POST_empresa=null;
        $POST_telefono=null;
        $POST_email=null;
        $POST_pais=null;
        $POST_region=null;
        $POST_provincia=null;
        $POST_comuna=null;
        $POST_direccion=null;
        $POST_usuario=null;
        $POST_latitud=null;
        $POST_longitud=null;
        $POST_nDiasDeReserva=null;

        $POST_caracteristicas=null;
        $POST_horarios=null;
        foreach (array_keys($content) as $key) {
            if($key=='local_nombre'){
                $POST_nombre=$content['local_nombre'];
            }
            if($key=='local_descripcion'){
                $POST_descripcion=$content['local_descripcion'];
            }    
            if($key=='empresa_id'){
                $POST_empresa=$content['empresa_id'];
            }
            if($key=='local_telefono'){
                $POST_telefono=$content['local_telefono'];
            }
            if($key=='local_email'){
                $POST_email=$content['local_email'];
            }
            if($key=='local_pais'){
                $POST_pais=$content['local_pais'];
            }
            if($key=='local_region'){
                $POST_region=$content['local_region'];
            }
            if($key=='local_provincia'){
                $POST_provincia=$content['local_provincia'];
            }
            if($key=='local_comuna'){
                $POST_comuna=$content['local_comuna'];
            }
            if($key=='local_direccion'){
                $POST_direccion=$content['local_direccion'];
            }
            if($key=='usuario_id'){
                $POST_usuario=$content['usuario_id'];
            }
            if($key=='local_latitud'){
                $POST_latitud=$content['local_latitud'];
            }
            if($key=='local_longitud'){
                $POST_longitud=$content['local_longitud'];
            }
            if($key=='local_ventana'){
                $POST_nDiasDeReserva=$content['local_ventana'];
            }
            if($key=='local_caracteristicas'){
                $POST_caracteristicas=$content['local_caracteristicas'];
            }
            if($key=='local_horario'){
                $POST_horarios=$content['local_horario'];
            }
        } 
        if(is_null($POST_nombre)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado un nombre para el local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_descripcion)){
            $MensajeParaRetornar=array('advertencia' => 'no has ingresado una descripcion para el local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
        }
        if(is_null($POST_empresa)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado el id de la empresa a la que pertenece este local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }else{
            $SupuestaEmpresa=Empresa::find($POST_empresa);
            if($SupuestaEmpresa == null){
                $MensajeParaRetornar=array('mensaje' => 'ingresaste un id de empresa que no existe');
                array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
                $seColocaronLosDatosMinimosRequeridos=false;
            }
        }
        if(is_null($POST_telefono)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado un telefono para el local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_email)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado un email para el local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_pais)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado el pais del local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_region)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado la region del local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_provincia)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado la provinvia del local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_comuna)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado la comuna del local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_direccion)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado la direccion del local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_usuario)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado el id del usuario que administra este local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }else{
            $SupuestoUsuario=User::find($POST_usuario);
            if($SupuestoUsuario == null){
                $MensajeParaRetornar=array('mensaje' => 'ingresaste un id de usuario que no existe');
                array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
                $seColocaronLosDatosMinimosRequeridos=false;
            }
        }
        if(is_null($POST_latitud)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado la latitud del local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_longitud)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado la longitud del local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_nDiasDeReserva)){
            $MensajeParaRetornar=array('mensaje' => 'no has ingresado una ventana de reserva para el local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }
        if(is_null($POST_caracteristicas)){
            $MensajeParaRetornar=array('advertencia' => 'no has dado caracteristicas a este local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
        }
        if(is_null($POST_horarios)){
            $MensajeParaRetornar=array('advertencia' => 'no has dado horarios a este local');
            array_push($erroresEnListaParaRetornar ,$MensajeParaRetornar);
        }
        if($seColocaronLosDatosMinimosRequeridos==false){
            $listaParaRetornar['status']='ERROR';
            $listaParaRetornar['items']=$erroresEnListaParaRetornar;
            //array_push($listaParaRetornar ,$MensajeParaRetornar);
            return response()->json($listaParaRetornar);
        } 
        $LocalCreado=local::create(  
            ['local_nombre' => $POST_nombre , 
             'local_descripcion' => $POST_descripcion, 
             'empresa_id' => $POST_empresa,
             'local_telefono' => $POST_telefono,
             'local_email' => $POST_email,
             'local_pais' => $POST_pais,
             'local_region' => $POST_region,
             'local_provincia' => $POST_provincia,
             'local_comuna' => $POST_comuna,
             'local_direccion' => $POST_direccion,
             'usuario_id' => $POST_usuario,
             'local_latitud' => $POST_latitud,
             'local_longitud' => $POST_longitud,
             'local_nDiasDeReserva' => $POST_nDiasDeReserva]);
        if(is_null($POST_caracteristicas)==false){
            $cantidadDeCaracteristicas=count($POST_caracteristicas);
            $contador=0;
            while ( $cantidadDeCaracteristicas > 0) {
                $LocalCreado->Caracteristicas()->attach(
                    ['caracteristicasLocal_id'=>$POST_caracteristicas[$contador]]);  
                $contador++;  
                $cantidadDeCaracteristicas--;
            }
        }
        if(is_null($POST_horarios)==false){
            $todosLosHorarios = count($POST_horarios);
            $contador=0;
            while ( $todosLosHorarios > 0) {
                $todosLosDatosDeUnHorario = count($POST_horarios[$contador]);
                //$contadorDos=0;
                while ( $todosLosDatosDeUnHorario > 0 ) {
                    //$columns = Schema::getColumnListing('t_horario');//tmb dv el id
                    $nuevoHorario = new Horario;
                    $nuevoHorario->horario_horaEntrada=$POST_horarios[$contador][0];
                    $nuevoHorario->horario_horaSalida=$POST_horarios[$contador][1];
                    $nuevoHorario->horario_tipo=$POST_horarios[$contador][2];
                    $nuevoHorario->horario_dia=$POST_horarios[$contador][3];
                    $LocalCreado->Horario()->save($nuevoHorario);
                    //$contadorDos++;  
                    $todosLosDatosDeUnHorario--;
                }             
                $contador++;  
                $todosLosHorarios--;
            }
        }

        $listaParaDv = array('status' => 'OK', 
            'items' => $erroresEnListaParaRetornar,
            'cuerpo' => $LocalCreado);
        return $listaParaDv;//$LocalCreado;
        echo "saliste del control";
        //return $POST_descripcion;
        //return Local::create($request->all());
    }

    public function show($local_id)
    {
        $local=Local::find($local_id);
        if(is_null($local)){
            $MensajeParaRetornar=array(
                'status' => 'ERROR',
                'mensaje' => 'ingresaste un id de local que no existe');
            return response()->json($MensajeParaRetornar);
        }

        // $evitarExeso = Local::find($local_id);
        // $Exeso = Local::find($local_id);
        // $TodaLaInfoDelLocalPeroBonito = array();
        // $unidadesDelLocal=array('unidades' => $local->Unidad);
        // $horariosDelLocal=array('horarios' => $local->Horario);
        // $GrupoDeCaracteriticasQueTieneUnLocal = [];
        // $grupoDeCaracteriticas = [];

        // foreach ($local->Caracteristicas as $value) {
        //     $caracteristicas = $value->GrupoCaracteristicas;
        //     $caracteristicas['items'] = $Exeso->Caracteristicas->where('grupo_id',$value['grupo_id']);
        //     foreach ($caracteristicas['items'] as $value) {
        //         unset($value->pivot);
        //     }
        //     array_push($grupoDeCaracteriticas ,$caracteristicas);
        //     //echo "$value.</br>";//['grupo_caracteristicas'];
        //     //echo $value['grupo_id'];
        // }
        // $GrupoDeCaracteriticasQueTieneUnLocal['grupo']=array_unique($grupoDeCaracteriticas);
        // array_push($TodaLaInfoDelLocalPeroBonito,
        //     $evitarExeso,
        //     $unidadesDelLocal,
        //     $horariosDelLocal,
        //     $GrupoDeCaracteriticasQueTieneUnLocal);
        // return response()->json($TodaLaInfoDelLocalPeroBonito);

        //$unidadesDeLosLocales=$local->Unidad;
        //$local->Unidad;
        foreach ($local->Unidad as $value) {
            //$value->Caracteristicas;
            //$value->makeHidden(['Caracteristicas']);
            foreach ($value->Caracteristicas as $value) {
                $value->makeHidden(['pivot']);//ocultar el pivot
            }
        }
        foreach ($local->Horario as $value) {
            $value->horario_horaEntrada = date("H:i", strtotime($value->horario_horaEntrada));
            $value->horario_horaSalida = date("H:i", strtotime($value->horario_horaEntrada));
        }
        $local->Caracteristicas;
        foreach ($local->Caracteristicas as $value) {
            $value->GrupoCaracteristicas;
        }
        $local->Galeria;
        return $local;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    
    public function ObtenerLocal(Request $r){
        $LoQueIngresoElUsuario=$r->get('ubicacion');
        
        $LocalSegunPais=Local::where('local_pais','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_region','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_provincia','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_comuna','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_direccion','LIKE',"%$LoQueIngresoElUsuario%")->get();
        if($LocalSegunPais->isEmpty()){
            $lista=array(
                'status' => 'ERROR',
                'mensaje' => 'no hay coincidencias');
            return response()->json($lista);           
        }else{
            foreach ($LocalSegunPais as $value) {
                $value->Unidad;
                $value->Galeria;
            }
            return $LocalSegunPais;
        } 
    }

    public function buscarMientrasNavegas($latitud,$longitud,$maximo){
        // $a=(-($maximo)+$latitud);
        // $b=$maximo+$latitud;
        // return $b;

        $localesCerca=Local::where('local_longitud','>',strval(-($maximo)+$longitud))
            //->orWhere('local_longitud','>',strval($longitud))
            ->Where('local_longitud','<',strval($maximo+$longitud))
            //->orWhere('local_longitud','<',strval($longitud))
            ->Where('local_latitud','>',strval(-($maximo)+$latitud))
            ->Where('local_latitud','<',strval($maximo+$latitud))
            ->get();
        return $localesCerca;

        // if(-16.0<$latitud){
        //     return 'lo que diste es mayor a -16.0';
        // }else{
        //     return 'lo que diste es menor a -16.0';
        // }
    }
}
