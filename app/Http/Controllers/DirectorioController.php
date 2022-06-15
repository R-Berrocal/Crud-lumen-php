<?php

namespace App\Http\Controllers;


use App\Directorio;
use Illuminate\Http\Request;

class DirectorioController extends Controller {
    
    //Get direcotrios
    public function index(Request $request)
    {
        if($request->has("txtBuscar")){
            return Directorio::whereTelefono($request->txtBuscar)
            ->orWhere("nombre_completo","like","%".$request->txtBuscar."%")->get();
        }
        return Directorio::all();
    }
    //Get directorios/id
    public function show($id){
        return Directorio::findOrFail($id); 
    }

    //POST directorios

    public function store(Request $request){

        //validar datos
        $this->validar($request);

        $input=$request->all();
        if($request->has("url_foto")) $input["url_foto"]=$this->cargarFoto($request->url_foto);

        Directorio::create($input);
        
        return response()->json([
            "res"=>true,
            "message"=>"Registro insertado correctamente",
            "directorio"=>$input
        ]);
    }

    //Put directorios/id
    public function update($id,Request $request){

        //validar datos
        $this->validar($request,$id);

        $input=$request->all();
        if($request->has("url_foto")) 
        $input["url_foto"]=$this->cargarFoto($request->url_foto);

        $directorio=Directorio::find($id);
        $directorio->update($input);
        
        return response()->json([
            "res"=>true,
            "message"=>"Registro modificado correctamente",
            "directorio"=>$input
        ]);
    }

    //Delete directorios/id
    public function delete($id){
        
        $input=Directorio::find($id);
        Directorio::destroy($id);
        
        return response()->json([
            "res"=>true,
            "message"=>"Registro eliminado correctamente",
            "directorio eliminado"=>$input
        ]);
    }

    private function validar($request, $id=null){
        $ruleUpdate = is_null($id) ? "" : "," . $id;
        $this->validate($request,[
            "nombre_completo"=>"required|min:3|max:100",
            //obvie el registro que estamos modificando para que no diga que el telefono ya existe
            "telefono"=>"required|unique:directorios,telefono" . $ruleUpdate
        ]);

    }
    private function cargarFoto($file){
        $nombreArchivo = time() . "." . $file -> getClientOriginalExtension();
        $file -> move(base_path("/public/fotografias"),$nombreArchivo);
        return $nombreArchivo;
    }
}