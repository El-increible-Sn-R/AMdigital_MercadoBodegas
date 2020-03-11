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
        $contenidosDelRequest = json_decode($request->getContent(),true);
        foreach (array_keys($contenidosDelRequest) as $key) {
            if($key=='usuario_id'){
                $POST_usuario=$contenidosDelRequest['usuario_id'];
                $SupuestoUsuario=User::find($POST_usuario);
                if($SupuestoUsuario == null){
                    $MensajeParaRetornar=array('mensaje' => 'ingresaste un id de usuario que no existe');
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
        $EmpresaCreada=Empresa::create($contenidosDelRequest);
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
            $contenidosDelRequest = json_decode($request->getContent(),true);
            foreach (array_keys($contenidosDelRequest) as $key) {
                if($key=='usuario_id'){
                    $SupuestoUsuario=User::find($contenidosDelRequest['usuario_id']);
                    if($SupuestoUsuario == null){
                        $MensajeParaRetornar=array('mensaje' => 'ingresaste un id de usuario que no existe');
                        array_push($ListaParaRetornar ,$MensajeParaRetornar);
                        $seColocaronLosDatosMinimosRequeridos=false;
                        break;
                    }
                }
                if ($key=='empresa_estaBorrado') {
                    $POST_estaBorrado=$contenidosDelRequest['empresa_estaBorrado'];
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
                        $MensajeParaRetornar=array('mensaje' => 'si quiere borra toda la empresa use la ruta propia para el borrado logico');
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
