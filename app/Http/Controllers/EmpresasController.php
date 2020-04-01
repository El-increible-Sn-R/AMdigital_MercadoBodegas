<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Empresa;
use App\User;
use App\Local;
use App\Unidad;

class EmpresasController extends Controller
{
    public function index()
    {
        $TodaslasEmpresas=Empresa::all();
        foreach ($TodaslasEmpresas as $value) {
            foreach ($value->Local as $value2) {
                $value2->Unidad;
            }
        }
        return $TodaslasEmpresas;
    }

    public function store(Request $request)
    {
        $seColocaronLosDatosMinimosRequeridos=true;
        $loQueSeDv = array();
        $ListaParaRetornar = array();
        $POST_usuario=null;
        $contenidosDelRequest = json_decode($request->getContent(),true);
        foreach (array_keys($contenidosDelRequest) as $key) {
            if($key=='usuario_id'){
                //ahora nos dara un array para representar que puedes insertarle muchos usuarios a esta empresa 
                $POST_usuario=$contenidosDelRequest['usuario_id'];
                $c=0;
                if(gettype($POST_usuario) != 'array'){
                    $MensajeParaRetornar=array('mensaje' => 'el parametro usuario_id debe ser un array');
                    array_push($ListaParaRetornar ,$MensajeParaRetornar);
                    $seColocaronLosDatosMinimosRequeridos=false;
                    break;    
                }
                $total=count($POST_usuario);
                if($total > 0){
                    while ($total > 0) {
                        $SupuestoUsuario=User::find($POST_usuario[$c]);
                        if ($SupuestoUsuario == null) {
                            $MensajeParaRetornar=array('mensaje' => "ingresaste un id de usuario que no existe en el indice [$c] del array usuario_id");
                            array_push($ListaParaRetornar ,$MensajeParaRetornar);
                            $seColocaronLosDatosMinimosRequeridos=false;
                        }else{
                            if($SupuestoUsuario->usuario_tipo=='e'){
                                $MensajeParaRetornar=array('mensaje' => "ingresaste un usuario de tipo empleado en el indice [$c] del array usuario_id");
                                array_push($ListaParaRetornar ,$MensajeParaRetornar);
                                $seColocaronLosDatosMinimosRequeridos=false;
                            }
                            if($SupuestoUsuario->usuario_tipo=='s'){
                                $MensajeParaRetornar=array('advertencia' => "no es necesario que coloques a los superEmpleados en el array usuario_id");
                                array_push($ListaParaRetornar ,$MensajeParaRetornar);
                            }
                        }                      
                        $c++;
                        $total--;
                    }                       
                }else{
                    $MensajeParaRetornar=array('mensaje' => "el array usuario_id esta vacio");
                    array_push($ListaParaRetornar ,$MensajeParaRetornar);
                    $seColocaronLosDatosMinimosRequeridos=false;                    
                }
            }
        }
        if(is_null($POST_usuario)){
            $MensajeParaRetornar=array('advertencia' => 'no has ingresado un usuario que administre esta empresa');
            array_push($ListaParaRetornar ,$MensajeParaRetornar);
        } 
        if ($seColocaronLosDatosMinimosRequeridos==false) {
            $loQueSeDv['status']='ERROR';
            $loQueSeDv['items']=$ListaParaRetornar;
            return $loQueSeDv;  
        }
        $EmpresaCreada=Empresa::create($contenidosDelRequest);

        if(is_null($POST_usuario)==false){

            foreach (User::all()->where('usuario_tipo','s') as $superUsuario) {
                $EsteSuperUsuarioEsta = false;
                foreach ($POST_usuario as $value) {
                    if ($value == $superUsuario->usuario_id) {
                        $EsteSuperUsuarioEsta=true;
                    }
                }
                if ($EsteSuperUsuarioEsta==false) {
                    array_push($POST_usuario,$superUsuario->usuario_id);
                }
                //array_push($POST_usuario,$superUsuario->usuario_id);
            }

            $cantidadDeUsuarios=count($POST_usuario);
            $contador=0;
            while ( $cantidadDeUsuarios > 0) {
                $EmpresaCreada->UsuariosAdministradores()->attach(
                    ['usuario_id'=>$POST_usuario[$contador]
                    //,'empresa_id'=>$EmpresaCreada->empresa_id
                    ]);  
                    $contador++;  
                    $cantidadDeUsuarios--;
            }
        }
        $MensajeParaRetornar=array('mensaje' => 'empresa creada con exito');
        array_push($ListaParaRetornar ,$MensajeParaRetornar);
        $loQueSeDv = array('status' => 'OK', 
            'items' => $ListaParaRetornar,
            'cuerpo' => $EmpresaCreada);
        return $loQueSeDv;
        echo "saliste del control,¿que hiciste?";
    }

    public function show($id)
    {
        $Empresa=Empresa::find($id);
        if(is_null($Empresa)){
            $MensajeParaRetornar['status']='ERROR';
            $ListaParaRetornar=array(
                    'mensaje' => 'ingresaste un id que no existe');
            $MensajeParaRetornar['items']=$ListaParaRetornar; 
            return $MensajeParaRetornar;
        }else{
            if ($Empresa->empresa_estaBorrado=='s') {
                $MensajeParaRetornar['status']='ERROR';
                $ListaParaRetornar=array(
                    'mensaje' => 'ingresaste un codigo de un local que fue eliminado');
                $MensajeParaRetornar['items']=$ListaParaRetornar; 
                return $MensajeParaRetornar;                                          
            }else{
                foreach ($Empresa->Local as $value2) {
                    $value2->Unidad;
                }
                $MensajeParaRetornar['status']='OK';
                $ListaParaRetornar=array(
                    'mensaje' => "se encontro la siguiente empresa con el ID: $id");
                $MensajeParaRetornar['items']=$ListaParaRetornar; 
                $MensajeParaRetornar['cuerpo']=$Empresa;
                return $MensajeParaRetornar;
            }
        }        
    }

    public function update(Request $request, $id)
    {
        $seColocaronLosDatosMinimosRequeridos=true;
        $loQueSeDv = array();
        $ListaParaRetornar = array();
        $EmpresaParaActualizar = Empresa::find($id);
        if($EmpresaParaActualizar != null){
            $POST_usuario=null;
            $contenidosDelRequest = json_decode($request->getContent(),true);
            foreach (array_keys($contenidosDelRequest) as $key) {
                if($key=='usuario_id'){
                    //ahora nos dara un array para representar que puedes insertarle muchos usuarios a esta empresa 
                    $POST_usuario=$contenidosDelRequest['usuario_id'];
                    $c=0;
                    if(gettype($POST_usuario) != 'array'){
                        $MensajeParaRetornar=array('mensaje' => 'el parametro usuario_id debe ser un array');
                        array_push($ListaParaRetornar ,$MensajeParaRetornar);
                        $seColocaronLosDatosMinimosRequeridos=false;
                        continue;    
                    }
                    $total=count($POST_usuario);
                    if($total > 0){
                        while ($total > 0) {
                            $SupuestoUsuario=User::find($POST_usuario[$c]);
                            if ($SupuestoUsuario == null) {
                                $MensajeParaRetornar=array('mensaje' => "ingresaste un id de usuario que no existe en el indice [$c] del array usuario_id");
                                array_push($ListaParaRetornar ,$MensajeParaRetornar);
                                $seColocaronLosDatosMinimosRequeridos=false;
                            }else{
                                if($SupuestoUsuario->usuario_tipo=='e'){
                                    $MensajeParaRetornar=array('mensaje' => "ingresaste un usuario de tipo empleado en el indice [$c] del array usuario_id");
                                    array_push($ListaParaRetornar ,$MensajeParaRetornar);
                                    $seColocaronLosDatosMinimosRequeridos=false;
                                }
                                if($SupuestoUsuario->usuario_tipo=='s'){
                                    $MensajeParaRetornar=array('advertencia' => "no es necesario que coloques a los superEmpleados en el array usuario_id");
                                    array_push($ListaParaRetornar ,$MensajeParaRetornar);
                                }
                            }                      
                            $c++;
                            $total--;
                        }                       
                    }else{
                        $MensajeParaRetornar=array('mensaje' => "el array usuario_id esta vacio");
                        array_push($ListaParaRetornar ,$MensajeParaRetornar);
                        $seColocaronLosDatosMinimosRequeridos=false;                    
                    }
                }
                if ($key=='empresa_estaBorrado') {
                    $POST_estaBorrado=$contenidosDelRequest['empresa_estaBorrado'];

                    if ($POST_estaBorrado=='n' || $POST_estaBorrado=='s') {
                         if ($POST_estaBorrado=='n') {
                            Local::where('empresa_id',$id)->update(['local_estaBorrado' => 'n']);
                            $MensajeParaRetornar=array('mensaje' => "todos los locales de la empresa fueron restaurados");
                            array_push($ListaParaRetornar ,$MensajeParaRetornar);  

                            $LocalesDeLaEmpresaAborrar=Local::where('empresa_id',$id)->get();
                            foreach ($LocalesDeLaEmpresaAborrar as $value) {
                                Unidad::where('local_id',$value->local_id)->update(['unidad_estaBorrado' => 'n','unidad_estaDisponible'=>'s']);
                            }
                            $MensajeParaRetornar=array('mensaje' => "todas las unidades de los locales de esta empresa fueron cambiadas a disponibles y restauradas exitosamente");
                            array_push($ListaParaRetornar ,$MensajeParaRetornar);   

                        }else{
                            $MensajeParaRetornar=array('mensaje' => 'si quiere borrar toda la empresa use la ruta propia para el borrado logico');
                            array_push($ListaParaRetornar ,$MensajeParaRetornar); 
                            $seColocaronLosDatosMinimosRequeridos=false; 
                        }
                    }else{
                        $MensajeParaRetornar=array('mensaje' => 'solo se permiten los valores <s> o <n>');
                        array_push($ListaParaRetornar ,$MensajeParaRetornar); 
                        $seColocaronLosDatosMinimosRequeridos=false;
                    }
                }
            } 
            if ($seColocaronLosDatosMinimosRequeridos==false) {
                $loQueSeDv['status']='ERROR';
                $loQueSeDv['items']=$ListaParaRetornar;
                return $loQueSeDv;  
            }
            $EmpresaParaActualizar->update($contenidosDelRequest);
            $loQueSeDv['status']='OK';
            $loQueSeDv['items']=$ListaParaRetornar;
            $loQueSeDv['cuerpo']=$EmpresaParaActualizar;

            //////////////
            if(is_null($POST_usuario)==false){
                foreach (User::all()->where('usuario_tipo','s') as $superUsuario) {
                    $EsteSuperUsuarioEsta = false;
                    foreach ($POST_usuario as $value) {
                        if ($value == $superUsuario->usuario_id) {
                            $EsteSuperUsuarioEsta=true;
                        }
                    }
                    if ($EsteSuperUsuarioEsta==false) {
                        array_push($POST_usuario,$superUsuario->usuario_id);
                    }
                    //array_push($POST_usuario,$superUsuario->usuario_id);
                }
                $EmpresaParaActualizar->UsuariosAdministradores()->detach();
                $cantidadDeUsuarios=count($POST_usuario);
                $contador=0;
                while ( $cantidadDeUsuarios > 0) {
                    $EmpresaParaActualizar->UsuariosAdministradores()->attach(
                        ['usuario_id'=>$POST_usuario[$contador]
                        //,'empresa_id'=>$EmpresaCreada->empresa_id
                        ]);  
                        $contador++;  
                        $cantidadDeUsuarios--;
                }
            }////////////////////

            return $loQueSeDv;  
        }else{
            $loQueSeDv['status']='ERROR';
            $ListaParaRetornar=array(
                'mensaje' => "no existe una empresa con el ID: $id");
            $loQueSeDv['items']=$ListaParaRetornar;
            return $loQueSeDv;
        }
    }

    public function destroy($id)
    {
        $loQueSeDv = array();
        $ListaParaRetornar = array();
        $EmpresaParaBorrar = Empresa::find($id);      
        if($EmpresaParaBorrar != null){

            Local::where('empresa_id',$id)->update(['local_estaBorrado' => 's']);
            $MensajeParaRetornar=array('mensaje' => "todos los locales de la empresa fueron borrados logicamente");
            array_push($ListaParaRetornar ,$MensajeParaRetornar);   
            
            $LocalesDeLaEmpresaAborrar=Local::where('empresa_id',$id)->get();
            foreach ($LocalesDeLaEmpresaAborrar as $value) {
                Unidad::where('local_id',$value->local_id)->update(['unidad_estaBorrado' => 's','unidad_estaDisponible'=>'n']);
            }
            $MensajeParaRetornar=array('mensaje' => "todas las unidades de los locales de esta empresa fueron cambiadas a no disponibles y borradas logicamente");
            array_push($ListaParaRetornar ,$MensajeParaRetornar);   

            $EmpresaParaBorrar->empresa_estaBorrado='s';
            $MensajeParaRetornar=array('mensaje' => "borrado logico de la empresa completado");
            array_push($ListaParaRetornar ,$MensajeParaRetornar);  
            $EmpresaParaBorrar->save();
            $loQueSeDv['status']='OK';
            $loQueSeDv['items']=$ListaParaRetornar;
            $loQueSeDv['cuerpo']=$EmpresaParaBorrar;
            return $loQueSeDv;
        }else{
            $loQueSeDv['status']='ERROR';
            $ListaParaRetornar=array(
                'mensaje' => "no existe una empresa con el ID: $id");
            $loQueSeDv['items']=$ListaParaRetornar;
            return $loQueSeDv;
        }
        echo 'saliste fuera de mis controles ¿que hiciste?';
    }    
}
