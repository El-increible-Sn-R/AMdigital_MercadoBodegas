<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Local;

class LocalesController extends Controller
{
    public function index()
    {
        //mostar todo:
        //return Local::all();
        //mostrar todo con las unidades:
        return Local::with('Unidad')->get();
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

        $local->Unidad;
        $local->Horario;
        $local->Caracteristicas;
        //print_r($horario);
        foreach ($local->Caracteristicas as $value) {
            $value->GrupoCaracteristicas;
        }
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
        //dd($r->get('ubicacion'));
        //$local=Local::name($r->get('ubicacion'));
        //$TodoslosLocales=Local::all();
        $LoQueIngresoElUsuario=$r->get('ubicacion');
        
        $LocalSegunPais=Local::where('local_pais','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_region','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_provincia','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_comuna','LIKE',"%$LoQueIngresoElUsuario%")
                ->orWhere('local_direccion','LIKE',"%$LoQueIngresoElUsuario%")->get();
        //print_r($LocalSegunPais);----->para el front tener un json especifico
        if($LocalSegunPais->isEmpty()){

            $lista=array(
                'status' => 'ERROR',
                'mensaje' => 'no hay coincidencias');
                //array_push($loQueSeDv,$value);
            return response()->json($lista);
            
        }else{
            //$r=$LocalSegunPais->Unidad; ///esto sale error por que es una arrya no un objeto
            //print_r($LocalSegunPais);    
            //$local = Local::find($LocalSegunPais[0]->local_id);//es lo hacemos asi pa q no sea array
            $unLocalYsusUnidades = [];
            //$loQueSeDv=[];
            foreach ($LocalSegunPais as $value) {
                //array_push($unLocalYsusUnidades,$value->Unidad);
                $value->Unidad;
                array_push($unLocalYsusUnidades,$value);
                //array_push($loQueSeDv,$unLocalYsusUnidades);
            }
            return $unLocalYsusUnidades;
            //return response()->json($loQueSeDv);
            //hacer que ret$LocalSegunPaisorne el primer local y todas sus unidades:
//            $local = Local::find($LocalSegunPais[0]->local_id);
//            $local->Unidad;
//            return $local;
        } 
    }
}
