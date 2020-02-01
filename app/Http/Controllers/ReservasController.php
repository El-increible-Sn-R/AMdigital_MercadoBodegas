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
        $POST_nombre = $request->Input('reserva_nombre','prueba');
        $POST_apellido = $request->Input('reserva_apellido','prueba');
        $POST_telefono = $request->Input('reserva_telefono','33333');
        $POST_email = $request->Input('reserva_email','adfa@dfsdf');
        $POST_fechaMudanza = $request->Input('reserva_fechaMudanza',null);
        $POST_unidad = $request->Input('unidad_id','5');
        
        $TodasLasReservasEnBDD = Reserva::all();
        //generamos el campo "reserva_codigo":
        $CAMPO_codigo=substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,8);
//        foreach ($TodasLasReservasEnBDD as $value) {
//            while($value->reserva_codigo==$CAMPO_codigo){
//                $CAMPO_codigo=substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,6);
//            }
//        }
        $SeRealizoLaReserva = true;
        $TodasLasReservasNOborradas=[];
        foreach ($TodasLasReservasEnBDD as $value) {
            //verifica que no exista otro codigo reserva exactamente igual:
            if($value->reserva_estaBorrado=='n'){
                array_push($TodasLasReservasNOborradas,$value);
            }
        }
        
        $ventanaDeReservas = 30;
        $fechaDeHoy = date("Y-m-d");        
        
        if(is_null($POST_fechaMudanza)){
            echo "no has ingresado la fecha de mudanza; se te asignara la fecha maxima permitidad por la ventana de reserva";
            echo "<br>";
            $POST_fechaMudanza = date("Y-m-d",strtotime($fechaDeHoy."+$ventanaDeReservas days"));
            echo $POST_fechaMudanza."<br>";
        }
        
        if($fechaDeHoy > $POST_fechaMudanza){
            echo "no puedes ingresar tal fecha: $fechaDeHoy > $POST_fechaMudanza ";
            echo "<br>";
        }
        else{
            echo "si puedes ingresar tal fecha: $fechaDeHoy < $POST_fechaMudanza ";
            echo "<br>";
            foreach ($TodasLasReservasNOborradas as $reserva) {
                if($reserva->reserva_email==$POST_email && 
                    $reserva->reserva_fechaMudanza==$POST_fechaMudanza &&
                    $reserva->unidad_id==$POST_unidad){
                    //echo $reserva->UnidadReserva."<br>";
                    //print_r($value);
                    echo "sospechoso de duplicado";
                    $SeRealizoLaReserva = false;
                }
            }
        }
        
        if($SeRealizoLaReserva==true){
            $horario = Unidad::find($POST_unidad)->Local->Horario;
            //$horrio2=$horario->local_id;
            //print_r($horario);
            //echo $horario;
            $HorarioDeAtencion="";
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
            echo "no es duplicado";            
            $ReservaCreada=Reserva::create( 
                    ['reserva_nombre' => $POST_nombre , 
                     'reserva_apellido' => $POST_apellido, 
                     'reserva_email' => $POST_email,
                     'reserva_telefono' => $POST_telefono,
                     'reserva_fechaMudanza' => $POST_fechaMudanza,
                     'reserva_estaBorrado' => 'n',
                     'unidad_id' => $POST_unidad,
                     'reserva_codigo' => $CAMPO_codigo,
                     'reserva_token_edition'=>"gaaaaaaaa"]);
            ///////////////////Enviar Correo de Confirmacion//////////////////////
            $DatosNecesarios = new \stdClass();
            $DatosNecesarios->codigoConfirmacion = $CAMPO_codigo;
            $DatosNecesarios->fechaMudanza = $POST_fechaMudanza;
            $DatosNecesarios->horarioDeAcceso = $HorarioDeAtencion;
            $DatosNecesarios->datosDeLaUnidad = $ReservaCreada->Unidad;
            $DatosNecesarios->datosDelLocal = $ReservaCreada->Unidad->Local;
            //Mail::to($POST_email)->send(new ConfirmacionDeReserva($DatosNecesarios));
            ////////////////////////////////////////////////////////////////////////
            return $ReservaCreada;
        }
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
        $POST_email = $request->Input('login_correo');
        $POST_codigo = $request->Input('login_codigo');
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
                return response()->json($lista);
            }
        }
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
