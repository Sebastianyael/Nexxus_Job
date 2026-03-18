<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function index($id){
        $empresas = Empresa::where('id' , $id)->first();

        if(!$empresas){
            $data = [
                "mensaje" => "No hay empresa registrada",
                "estatus" => 404
            ];

            return response()->json($data , 404);        
        }

        $data = [
            "mensaje" => "Datos de la Empresa",
            "estatus" => 200,
            "empresas" => $empresas
        ];

        return response()->json($data , 200);
    }

    public function store(Request $request)
{

    $validacion = Validator::make($request->all(), [
        "nombre"     => "required",
        "giro"       => "required",
        "telefono"   => "required",
        "email"      => "required",
        "contraseña" => "required",
        "calle"      => "required",
        "municipio"  => "required",
        "cp"         => "required",
        "colonia"    => "required",
    ]);

    if ($validacion->fails()) {
        return response()->json([
            "mensaje" => "La validación falló",
            "errors"  => $validacion->errors(),
            "estatus" => 400
        ], 400);
    }

    $empresa = Empresa::create([
        "nombre"     => $request->nombre,
        "giro"       => $request->giro,
        "telefono"   => $request->telefono,
        "email"      => $request->email,
        "contraseña" => $request->contraseña, 
        "calle"      => $request->calle,
        "MUNICIPIO"  => $request->municipio,
        "cp"         => $request->cp,
        "colonia"    => $request->colonia,
    ]);

    return response()->json([
        "mensaje" => "Empresa registrada correctamente",
        "estatus" => 201,
        "empresa" => $empresa
    ], 201);
}

    public function update(Request $request , $id){
        $empresa = Empresa::where('id' , $id)->first();

        $validacion = Validator::make($request->all() , [
            "nombre" => "required",
            "giro" => "required",
            "telefono" => "required",
            "email" => "required",
            "contraseña" => "required",
            "calle" => "required",
            "cp" => "required",
            "colonia" => "required",
            "municipio" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "La validacion fallo",
                'error' => $validacion->errors(),
                "estatus" => 400
            ];

            return response()->json($data , 400);
        }
       
        $empresa->nombre = $request->nombre;
        $empresa->giro = $request->giro;
        $empresa->telefono = $request->telefono;
        $empresa->email = $request->email;
        $empresa->contraseña = $request->contraseña;
        $empresa->calle = $request->calle;
        $empresa->cp  = $request->cp;
        $empresa->colonia = $request->colonia;
        $empresa->MUNICIPIO = $request->municipio;

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
