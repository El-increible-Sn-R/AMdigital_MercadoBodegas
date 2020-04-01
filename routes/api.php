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

    //---------------------------------------USUARIOS---------------------------------------------
    //registrarte:
    Route::post('signup','authController@signup'); 
    //logearse:
    Route::post('login','authController@login');
    //rutas para las que necesitas estar logeado:
    Route::group(['middleware'=>'auth:api'],function(){
        //cerrar sesion:
        Route::get('logout','authController@logout');
        //dv un usuario por id:
        Route::get('usuario','authController@show');
    });
    //-----------------------------------------LOCALES----------------------------------------------
    //dv un local por id:http://localhost:8000/api/locales/{1}
    //insertar un local:http://localhost:8000/api/locales+(json por POST) 
    //dv todos los locales:http://localhost:8000/api/locales     
    Route::resource('/locales','LocalesController')->only(['index','show','store']);

    //dv resutados de una busqueda:http://localhost:8000/api/ruta/?ubicacion=peru
    Route::get('/ruta', 'LocalesController@ObtenerLocal');

    //mientras navegas:http://localhost:8000/api/locales/busquedaPosicion/-16.0/-71.0/0.51/0.51
    Route::get('/locales/busquedaPosicion/{latitud}/{longitud}/{sumarLatitud}/{sumarLongitud}','LocalesController@buscarMientrasNavegas');

    //actualizar local: http://localhost:8000/api/locales/modificarLocal/1
    Route::post('/locales/modificarLocal/{id}','LocalesController@update');

    //borrado logico del local:http://localhost:8000/api/locales/borrarLocal/4
    Route::get('/locales/borrarLocal/{id}','LocalesController@destroy');

    //-------------------------------------------RESERVAS-------------------------------------------
    //dv todas las reservas:http://localhost:8000/api/reservas
    //dv una reserva por id: http://localhost:8000/api/reservas/{id}
    Route::resource('/reservas','ReservasController')->only(['index','show']);

    //dv una reserva por codigo:http://localhost:8000/api/reservas/buscarReserva/T188VFB7
    Route::get('/reservas/buscarReserva/{reserva_codigo}','ReservasController@buscarReservaPorCodigo');

    //Para borrar una reserva: http://localhost:8000/api/reservas/borrar/6
    Route::get('/reservas/borrar/{id}','ReservasController@BorradoLogico');  
    
    //login de modificar una reserva:http://localhost:8000/api/reservas/loginModificarReserva
    Route::post('/reservas/loginModificarReserva','ReservasController@LoginParaModificarReserva');
    
    //ruta para modificar/actualisar una reserva:
    Route::post('/reservas/modificarReserva','ReservasController@ActualizarUnaReserva');

    //ruta para insertar una reserva:http://localhost:8000/api/reservas/insertarReserva
    Route::post('/reservas/insertarReserva','ReservasController@store');
    
    //--------------------------------------------UNIDADES------------------------------------------
    //dv todas las unidades:http://localhost:8000/api/unidades
    //insetar una unidad:http://localhost:8000/api/unidades+(json/text por POST) 
    //dv una unidad por id:http://localhost:8000/api/unidades/{id}  
    Route::apiResource('/unidades','UnidadController')->only(['index','store','show']);

    //actualizar una unidad:http://localhost:8000/api/unidades/{id}+(json por POST) 
    Route::post('/unidades/modificarUnidad/{id}','UnidadController@update');

    //eliminar una unidad: http://localhost:8000/api/unidades/borrarUnidad/28
    Route::get('/unidades/borrarUnidad/{id}','UnidadController@destroy');

    //----------------------------------------------EMPRESAS----------------------------------------
    //dv todas las empresas:http://localhost:8000/api/empresas
    //insertar una empresa:http://localhost:8000/api/empresas+(json/text por POST)
    //dv una empresa por id:http://localhost:8000/api/empresas/589 
    Route::apiResource('/empresas','EmpresasController')->only(['index','store','show']);

    //actualizar una empresa:http://localhost:8000/api/empresas/modificarEmpresa/777
    Route::post('/empresas/modificarEmpresa/{id}','EmpresasController@update');

    //eliminar una empresa:http://localhost:8000/api/empresas/modificarEmpresa/777
    Route::get('/empresas/borrarEmpresa/{id}','EmpresasController@destroy');
});
//consultas espaciales en laravel
//como hace laravel para servir imagenes estaticas
