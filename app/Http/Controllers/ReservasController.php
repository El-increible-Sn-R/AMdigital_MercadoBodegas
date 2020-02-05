<?php
namespace App\Http\Controllers;
use App\Reserva;
use App\Unidad;
use Illuminate\Http\Request;
use App\Mail\ConfirmacionDeReserva;
use Illuminate\Support\Facades\Mail;

class ReservasController extends Controller
{
    public function index(){
        return Reserva::all();
    }

    public function create()
    {
        //NO PARA APIS
    }

    public function store(Request $request){
        $POST_nombre = $request->Input('reserva_nombre','datoGeneradoAutomaticamente');
        $POST_apellido = $request->Input('reserva_apellido','datoGeneradoAutomaticamente');
        $POST_telefono = $request->Input('reserva_telefono','000000000');
        $POST_email = $request->Input('reserva_email',null);
        $POST_fechaMudanza = $request->Input('reserva_fechaMudanza',null);
        $POST_unidad = $request->Input('unidad_id',null);        
        //$TodasLasReservasEnBDD = Reserva::all();
        //generamos el campo "reserva_codigo":
        $CAMPO_codigo=substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,8);
        $SeRealizoLaReserva = true;
        $seColocaronLosDatosMinimosRequeridos = true;
        $TodasLasReservasNOborradas=[];
        $listaParaRetornar = array();
        $ventanaDeReservas = 30;
        $fechaDeHoy = date("Y-m-d");     

        foreach (Reserva::all() as $value) {
            //verifica que no exista otro codigo reserva exactamente igual:
            if($value->reserva_estaBorrado=='n'){
                array_push($TodasLasReservasNOborradas,$value);
            }
        }

        if(is_null($POST_email)){
            $QuintoMensajeParaRetornar=array(
                    'mensaje' => 'no has ingresado el Correo',
                    'status' => 'ERROR');
            array_push($listaParaRetornar ,$QuintoMensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        } 

        if(is_null($POST_unidad)){
            $SextoMensajeParaRetornar=array(
                    'mensaje' => 'no has ingresado una unidad',
                    'status' => 'ERROR');
            array_push($listaParaRetornar ,$SextoMensajeParaRetornar);
            $seColocaronLosDatosMinimosRequeridos=false;
        }else{
            $unidadIngresada=Unidad::find($POST_unidad);
            if($unidadIngresada == null){
                $SextoMensajeParaRetornar=array(
                    'mensaje' => 'ingresaste un id de unidad que no existe',
                    'status' => 'ERROR');
                array_push($listaParaRetornar ,$SextoMensajeParaRetornar);
                $seColocaronLosDatosMinimosRequeridos=false;
            }
        } 

        if($seColocaronLosDatosMinimosRequeridos==false){
            return response()->json($listaParaRetornar);
        }
        
        if(is_null($POST_fechaMudanza)){
            $PrimerMensajeParaRetornar=array(
                    'mensaje' => 'no has ingresado la fecha de mudanza; se te asignara la fecha maxima permitidad por la ventana de reserva',
                    'status' => 'advertencia');
            array_push($listaParaRetornar ,$PrimerMensajeParaRetornar);
            $POST_fechaMudanza = date("Y-m-d",strtotime($fechaDeHoy."+$ventanaDeReservas days"));
        } 
        
        if($fechaDeHoy > $POST_fechaMudanza){
            $SegundoMensajeParaRetornar=array(
                    'mensaje' => "no puedes ingresar tal fecha: $fechaDeHoy > $POST_fechaMudanza ",
                    'status' => 'ERROR');
            array_push($listaParaRetornar ,$SegundoMensajeParaRetornar);
            return response()->json($listaParaRetornar);
        }else{
            // echo "si puedes ingresar tal fecha: $fechaDeHoy < $POST_fechaMudanza ";
            // echo "<br>";
            foreach ($TodasLasReservasNOborradas as $reserva) {
                if($reserva->reserva_email==$POST_email && 
                    $reserva->reserva_fechaMudanza==$POST_fechaMudanza &&
                    $reserva->unidad_id==$POST_unidad){
                    //echo $reserva->UnidadReserva."<br>";
                    //print_r($value);
                    $TercerMensajeParaRetornar=array(
                        'mensaje' => 'sospechoso de duplicado',
                        'status' => 'ERROR');
                    array_push($listaParaRetornar ,$TercerMensajeParaRetornar);
                    //echo "sospechoso de duplicado";
                    $SeRealizoLaReserva = false;
                }
            }
        } 
        if($SeRealizoLaReserva==true){
            $horario = Unidad::find($POST_unidad)->Local->Horario;
            /////¿que pasa si el local resien se creo y no tiene horario?/////
            $HorarioDeAtencion="horario muy cambiante";
            $semana=[];
            $semana1=['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
            $semana2=['lunes','martes','miercoles','jueves','viernes',];
            foreach ($horario as $value) {
                if($value->horario_tipo=='o'){
                    array_push($semana,$value->horario_dia);
                }
            }
            if($semana==$semana1){
                $HorarioDeAtencion="de lunes a domingo";
            }
            if($semana==$semana2){
                $HorarioDeAtencion="de lunes a viernes";
            }           
            $ReservaCreada=Reserva::create( 
                    ['reserva_nombre' => $POST_nombre , 
                     'reserva_apellido' => $POST_apellido, 
                     'reserva_email' => $POST_email,
                     'reserva_telefono' => $POST_telefono,
                     'reserva_fechaMudanza' => $POST_fechaMudanza,
                     'reserva_estaBorrado' => 'n',
                     'unidad_id' => $POST_unidad,
                     'reserva_codigo' => $CAMPO_codigo,
                     'reserva_token_edition'=>"TOKENcreadoAloBESTIA"]);
            ///////////////////Enviar Correo de Confirmacion//////////////////////
            $DatosNecesarios = new \stdClass();
            $DatosNecesarios->codigoConfirmacion = $CAMPO_codigo;
            $DatosNecesarios->fechaMudanza = $POST_fechaMudanza;
            $DatosNecesarios->horarioDeAcceso = $HorarioDeAtencion;
            $DatosNecesarios->datosDeLaUnidad = $ReservaCreada->Unidad;
            $DatosNecesarios->datosDelLocal = $ReservaCreada->Unidad->Local;
            //Mail::to($POST_email)->send(new ConfirmacionDeReserva($DatosNecesarios));
            ////////////////////////////////////////////////////////////////////////
            //return $ReservaCreada;
            $CuartoMensajeParaRetornar=array(
                'mensaje' => 'reserva creada con exito',
                'status' => 'ok');
            array_push($listaParaRetornar,$CuartoMensajeParaRetornar);
            return response()->json($listaParaRetornar);
        }
        return response()->json($listaParaRetornar);
    }

    public function show($id)
    {
        $reserva= Reserva::find($id);
        return $reserva;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {//esta "eliminacion" ya no se husa
        $reservaParaActualizar=Reserva::find($id);
        $reservaParaActualizar->update($request->all());
        return $reservaParaActualizar;
    }

    public function destroy($id)
    {
        //
    }
    
    public function BorradoLogico($id){
        //$LoQueIngresoElUsuario=$id->get('id');
        $reservaParaBorrar=Reserva::find($id);
        if($reservaParaBorrar != null){
            $reservaParaBorrar->reserva_estaBorrado='s';
            $reservaParaBorrar->save();
            echo $reservaParaBorrar;
        }else{
            echo "no se encontro tal reserva";
        }
    }
    
    public function LoginParaModificarReserva(Request $request){
        /////////////////////////////////////////////////////////////////////////////////12soles///
        $llave = true;
        $lista = array();
        //$POST_email = $request->Input('login_correo');
        //$POST_codigo = $request->Input('login_codigo');
        //echo ($request);
        //print_r($request->getContent());
        
        $content = json_decode($request->getContent(),true);    
        $POST_email=$content['login_correo'];
        $POST_codigo=$content['login_codigo'];
        //print_r($content['login_correo']);

        $TodasLasReservasNOborradas=[];
        foreach (Reserva::all() as $value) {
            if($value->reserva_estaBorrado=='n'){
                array_push($TodasLasReservasNOborradas,$value);
            }
        }
        foreach ($TodasLasReservasNOborradas as $reserva) {
        
            if($reserva->reserva_email==$POST_email && $reserva->reserva_codigo==$POST_codigo){
                $lista=array(
                    'mensaje' => 'login correcto',
                    'token' => $reserva->reserva_token_edition,
                    'status' => 'ok');
                //array_push($loQueSeDv,$value);
                return response()->json($lista);
            }else{
                $lista=array(
                    'mensaje' => 'login incorrecto',
                    'status' => 'ERROR');
                //array_push($loQueSeDv,$value);
                $llave = false;
            }
        }
        if($llave==false){
            return response()->json($lista);
        }

        ///////caprichos random////////
        //echo $request;
    }
    
    public function ActualizarUnaReserva(Request $request){
        $POST_nombre = $request->Input('reserva_nombre',null);
        $POST_apellido = $request->Input('reserva_apellido',null);
        $POST_email = $request->Input('login_correo');
        $POST_telefono = $request->Input('reserva_telefono',null);
        $POST_fechaMudanza = $request->Input('reserva_fechaMudanza',null);
        $POST_token = $request->Input('reserva_token_edition');
        $POST_codigo = $request->Input('login_codigo');     
        //$cambios=true;
        $TodasLasReservasNOborradas=[];
        foreach (Reserva::all() as $value) {
            if($value->reserva_estaBorrado=='n'){
                array_push($TodasLasReservasNOborradas,$value);
            }
        }
        foreach ($TodasLasReservasNOborradas as $reserva) {
            if($reserva->reserva_email == $POST_email && 
                $reserva->reserva_codigo == $POST_codigo && 
                $reserva->reserva_token_edition == $POST_token){
                //$camposDeReserva=array('reserva_nombre','reserva_apellido','reserva_telefono','reserva_fechaMudanza');
                if(is_null($POST_nombre)==false){
                    //unset($camposDeReserva[0]);
                    $reserva->reserva_nombre=$POST_nombre;
                }
                if(is_null($POST_apellido)==false){
                    //unset($camposDeReserva[1]);
                    $reserva->reserva_apellido=$POST_apellido;
                }
                if(is_null($POST_telefono)==false){
                    //unset($camposDeReserva[2]);
                    $reserva->reserva_telefono=$POST_telefono;
                }
                if(is_null($POST_fechaMudanza)==false){
                    $reserva->reserva_fechaMudanza=$POST_fechaMudanza;
                }
                $reserva->save();
                return $reserva;
            }
//            else{
//                $cambios = false;
//            }
        }
        //if($cambios==false){
        echo "no se cambio nada";
        //}
    }
    
}
