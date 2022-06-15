<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller{
    public function store(Request $request){

        

        $input=$request->all();
        $input["password"]= Hash::make($request->password);
        User::create($input);
        
        return response()->json([
            "res"=>true,
            "message"=>"Registro insertado correctamente",
            "directorio"=>$input
        ]);
    }

    public function login(Request $request){
        $user = User::whereEmail($request->email)->first();

        //si existe un usuario y su clave es igual a la de la peticion pasa
        if(!is_null($user) && Hash::check($request->password,$user->password)){

            $user->api_token=Str::random(150);
            $user->save();
            return response()->json([
                "res"=>true,
                "token"=>$user->api_token,
                "message"=>"Bienvenido al sistema",
            ]);
        }else{
            return response()->json([
                "res"=>false,
                "message"=>"Cuenta o password incorrectos",
            ]);
        }
    }
    public function logout(){
        $user=auth()->user();
        $user->api_token=null;
        $user->save();

        return response()->json([
            "res"=>true,
            "message"=>"Adios",
        ]);
    }
}