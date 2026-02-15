<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function index(){
        $empresas = Empresa::all();

        if($empresas -> isEmpty()){
            $data = [
                "mensaje" => "No hay empresas registradas",
                "estatus" => 404
            ];

            return response()->json($data , 404);        
        }

        $data = [
            "mensaje" => "Lista de empresas registradas",
            "estatus" => 200,
            "empresas" => $empresas
        ];

        return response()->json($data , 200);
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all() , [
            "nombre" => "required",
            "giro" => "required",
            "telefono" => "required",
            "email" => "required",
            "calle" => "required",
            "colonia" => "required",
            "municipio" => "required",
            "codigo_postal" => "required",
            "estado" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "La validacion fallo",
                'error' => $validacion->errors(),
                "estatus" => 400
            ];

            return reponse()->json($data , 400);
        }

       $empresa = Empresa::create([
            "nombre" => $request->nombre,
            "giro" => $request->giro,
            "telefono" => $request->telefono,
            "email" => $request->email,
            "calle" => $request->calle,
            "colonia" => $request->colonia,
            "municipio" => $request->municipio,
            "codigo_postal" => $request->codigo_postal,
            "estado" => $request->estado
        ]); 

        $data = [
            "mensaje" => "Empresa registrada correctamente",
            "estatus" => 200,
            "empresa" => $empresa
        ];

        return response()->json($empresa,200);
    }

    public function update(Request $request , $id){
        $empresa = Empresa::find($id);

        $validacion = Validator::make($request->all() , [
            "nombre" => "required",
            "giro" => "required",
            "telefono" => "required",
            "email" => "required",
            "calle" => "required",
            "colonia" => "required",
            "municipio" => "required",
            "codigo_postal" => "required",
            "estado" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "La validacion fallo",
                'error' => $validacion->errors(),  
                "estatus" => 400
            ];

            return respose() -> json($data,400);
        }


        $empresa->nombre = $request->nombre;
        $empresa->giro = $request->giro;
        $empresa->telefono = $request->telefono;
        $empresa->email = $request->email;
        $empresa->calle = $request->calle;
        $empresa->colonia = $request->colonia;
        $empresa->municipio = $request->municipio;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->estado = $request->estado;

        $empresa->save();

        $data = [
            "mensaje" => "Empresa actualizada",
            "estatus" => 200,
            "empresa" => $empresa
        ];
        

        return response()->json($data , 200);

    }

    public function destroy(Request $request , $id){
        $empresa = Empresa::find($id);

        if(!$empresa){
            $data = [
                "mensaje" => "Empresa no encontrada",
                "estatus" => 404
            ];

            return response()->json($data , 404);
        }

        $empresa->delete();

        $data = [
            "mensaje" => "Empresa eliminada correctamente",
            "estatus" => 200
        ];
        return response()->json($data , 200);

    }
}
