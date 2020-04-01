<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function signup(Request $request){
    	$ListaParaRetornar = array();
    	$rules = [
    		'usuario_nombre'	 =>'required|string',
    		'usuario_apellido'	 =>'required|string',
    		'usuario_telefono'	 =>'required|numeric',
    		'usuario_login'		 =>'required|string',
    		'usuario_contrasenia'=>'required|string|confirmed',
    		'usuario_tipo'		 =>'required|in:a,e'
            ];
        $messages = [
        	//el usuario apellido y :other => 'El :attribute y :other'
		    'usuario_nombre.required'    => 'El nombre es requerido para el registro',
		    'usuario_apellido.required'  => 'El apellido es requerido para el registro',
		    'usuario_telefono.required'  => 'El telefono es requerido para el registro',
		    'usuario_telefono.numeric'   => 'El telefono solo puede tener numeros',
		    'usuario_login.required'  	 => 'El nombre de usuario es requerido para el registro',
		    'usuario_contrasenia.required' => 'La contraseña es requerida para el registro',
		    'usuario_contrasenia.confirmed'=> 'La confirmacion de la contraseña fue incorrecta',
		    'usuario_tipo.required'	 	 => 'El tipo de usuario es requerido para el registro',
		    'usuario_tipo.in'	 		 => 'Los tipos de usuario son Administrador<a> o empleado<e>',
		];    
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
        	foreach ($validator->errors()->all() as $message) {
        		$MensajeParaRetornar=array('mensaje'=>$message);
        		array_push($ListaParaRetornar ,$MensajeParaRetornar); 
			}
        	$loQueSeDv['status']='ERROR';
            $loQueSeDv['items']=$ListaParaRetornar;
            return $loQueSeDv;
     	}
     	else{
     		$nuevoUsuario = new User([
     			'usuario_nombre'	 =>$request->usuario_nombre,
    			'usuario_apellido'	 =>$request->usuario_apellido,
    			'usuario_telefono'	 =>$request->usuario_telefono,
    			'usuario_login'		 =>$request->usuario_login,
    			'usuario_contrasenia'=>bcrypt($request->usuario_contrasenia),
    			'usuario_tipo'		 =>$request->usuario_tipo
     		]);
     		$nuevoUsuario->save();
     		//User::create($request->all());
     		$MensajeParaRetornar=array('mensaje'=>'el usuario a sido registrado con exito');
        	array_push($ListaParaRetornar ,$MensajeParaRetornar); 
     		$loQueSeDv = array('status' => 'OK', 
            	'items' => $ListaParaRetornar,
            	);
        	return $loQueSeDv;
        }
        echo "saliste del control,¿que hiciste?";
    }

    public function login(Request $request){
    	$ListaParaRetornar = array();
    	$rules = [
    		'usuario_login'		 =>'required|string',
    		'usuario_contrasenia'=>'required|string'
    		//'remember_me'		 =>'boolean'
            ];
        $messages = [
		    'usuario_login.required'  	 => 'El nombre de usuario es requerido',
		    'usuario_contrasenia.required' => 'La contraseña es requerida',
		    // 'usuario_contrasenia.confirmed'=> 'La confirmacion de la contraseña fue incorrecta',
		    // 'usuario_tipo.required'	 	 => 'El tipo de usuario es requerido para el registro',
		    // 'usuario_tipo.in'	 		 => 'Los tipos de usuario son Administrador<a> o empleado<e>',
		];    
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        	foreach ($validator->errors()->all() as $message) {
        		$MensajeParaRetornar=array('mensaje'=>$message);
        		array_push($ListaParaRetornar ,$MensajeParaRetornar); 
			}
        	$loQueSeDv['status']='ERROR';
            $loQueSeDv['items']=$ListaParaRetornar;
            return $loQueSeDv;
     	}
        
        $credenciales=request(['usuario_login','usuario_contrasenia']);
        if (!Auth::attempt($credenciales)) {
        	$MensajeParaRetornar=array('mensaje'=>'login incorrecto');
        	array_push($ListaParaRetornar ,$MensajeParaRetornar); 
        	$loQueSeDv['status']='ERROR';
            $loQueSeDv['items']=$ListaParaRetornar;
            return $loQueSeDv;
        }
        $usuarioLogeado=$request->user();
        $tokenParaEstaSesion=$usuarioLogeado->createToken('Personal Access Token');
        $token=$tokenParaEstaSesion->token;
        $token->save();

        $MensajeParaRetornar=array('mensaje'=>'iniciaste sesion correctamente');
        array_push($ListaParaRetornar ,$MensajeParaRetornar); 
        $MensajeParaRetornar=array('access_token'=>$tokenParaEstaSesion->accessToken);
        array_push($ListaParaRetornar ,$MensajeParaRetornar); 
        $MensajeParaRetornar=array('token_type'=>'Bearer');
        array_push($ListaParaRetornar ,$MensajeParaRetornar); 
        $MensajeParaRetornar=array('expirara'=>$tokenParaEstaSesion->token->expires_at);
        array_push($ListaParaRetornar ,$MensajeParaRetornar); 

     	$loQueSeDv = array('status' => 'OK', 
            'items' => $ListaParaRetornar,
            );
        return $loQueSeDv;
    }
}
