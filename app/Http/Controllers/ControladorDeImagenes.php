<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
//use Storage;

class ControladorDeImagenes extends Controller
{
    public function save(Request $request)
	{  //obtenemos el campo file definido en el formulario
       $file = $request->file('file');
       //print_r($file);
       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
       //indicamos que queremos guardar un nuevo archivo en el disco local
       //Storage::disk('enLaCarpetaPublic')->put($nombre,\File::get($file));
       //Storage::disk('enLaCarpetaPublic')->put($nombre,$file);
       \Storage::disk('enLaCarpetaPublic')->put($nombre,\File::get($file));
       return "archivo guardado";

       
	}
}
