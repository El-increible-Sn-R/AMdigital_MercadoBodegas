<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Local;

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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return Local::create($request->all());
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
}
