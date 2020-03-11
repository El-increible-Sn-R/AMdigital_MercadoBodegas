<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ppp', function () {
    return "hola";
});

Route::get
('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//--------------------------------------------IMAGENES---------------------------------------
//ver una imagen por su nombre:http://localhost:8000/static/imagenes/1i.jpg
Route::get('/static/imagenes/{archivo}', function($archivo) {
    //return File::get(public_path().'/borrame/1a.jpg');
    //return Storage::get('/borrame/1a.jpg');
    //return Storage::disk('muyAfuera')->get('/borrame/1a.jpg');///dv simbolos raros

    //esto demora mucho, creo que es mas grnade los simbolos o algo...
 	// $filePath = '/borrame/1b.png';
	// $content = Storage::disk('muyAfuera')->get($filePath);
	// dd($content);

	//esto descarga la imagen,no la muestra en el navegador
	//return Storage::disk('muyAfuera')->download('/borrame/1a.jpg'); 

	//esto la muestra en el navegador:
	// $public_path = public_path();//////////////
 	//$url = $public_path.'/borrame/1a.jpg';//////MAL
	// return Storage::response($url); ///////////
	return Storage::disk('enLaCarpetaPublic')->response('/borrame/'.$archivo); ///BIEN
});

//Route::get('verGaleria','StorageController@index');

//agregar imagen:http://localhost:8000/imagenes/agregar + (algo por form-data)
Route::post('imagenes/agregar', 'ControladorDeImagenes@save');
Route::get('storage/{archivo}', function ($archivo) {
    $public_path = public_path();
    $url = $public_path.'/borrame/'.$archivo;
    //print_r($url);
    //verificamos si el archivo existe y lo retornamos
    if (Storage::exists($archivo))
    {
    	return response()->download($url);
    }
    //si no se encuentra lanzamos un error 404.
    abort(404);
});

