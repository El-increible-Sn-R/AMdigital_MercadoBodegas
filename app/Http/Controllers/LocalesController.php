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
        $local->Unidad;
        $local->Horario;
        //$local->Caracteristicasss;
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
        
        $LocalSegunPais=Local::where('local_pais','LIKE',"$LoQueIngresoElUsuario")
                ->orWhere('local_region','LIKE',"$LoQueIngresoElUsuario")
                ->orWhere('local_comuna','LIKE',"$LoQueIngresoElUsuario")
                ->orWhere('local_direccion','LIKE',"%$LoQueIngresoElUsuario%")->get();
        //print_r($LocalSegunPais);----->para el front tener un json especifico
        if($LocalSegunPais->isEmpty()){
            return "no hay coincidencias";
            
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
