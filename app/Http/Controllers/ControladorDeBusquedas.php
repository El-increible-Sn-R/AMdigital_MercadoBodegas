<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Local;

class ControladorDeBusquedas extends Controller
{
    public function ObtenerLocal(Request $r){
        //dd($r->get('ubicacion'));
        $local=Local::name($r->get('ubicacion'));
        $TodoslosLocales=Local::all();
        return $local;
    }
}
