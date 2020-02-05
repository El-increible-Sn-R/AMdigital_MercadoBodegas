<?php
use Illuminate\Http\Request;
/*API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API! */

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware'=>'cors'],function(){
    //-----------------------------------------LOCALES-------------------------------------------------------
    //ruta para obtener un local en particular:http://localhost:8000/api/locales/{1}
    //ruta para mostrar todos los locales:http://localhost:8000/api/locales
    Route::resource('/locales','LocalesController');

    //ruta de mostrar resutados de una busqueda:http://localhost:8000/api/ruta/?ubicacion=peru
    Route::get('/ruta', 'LocalesController@ObtenerLocal');

    //-------------------------------------------RESERVAS----------------------------------------------------
    //ruta para mostrar todas las reservas: http://localhost:8000/api/reservas
    //ruta para insertar una reserva://http://localhost:8000/api/reservas + (algo por POST)
    //ruta para actualisar una reserva://http://localhost:8000/api/reservas/{id} + (algo por PUT)//----nel
    //ruta que retorna una reserva por id: http://localhost:8000/api/reservas/{id}
    Route::resource('/reservas','ReservasController');

    //ruta para borrar una reserva: http://localhost:8000/api/reservas/borrar/6
    Route::get('/reservas/borrar/{id}','ReservasController@BorradoLogico');  
    
    //ruta para el login de modificar una reserva: http://localhost:8000/api/reservas/loginModificarReserva
    Route::post('/reservas/loginModificarReserva','ReservasController@LoginParaModificarReserva');
    
    //ruta para modificar/actualisar una reserva:
    Route::post('/reservas/modificarReserva','ReservasController@ActualizarUnaReserva');

    Route::post('/reservas/insertarReserva','ReservasController@store');
    
});
