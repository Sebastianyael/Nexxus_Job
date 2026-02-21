<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Postulacion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class PostulacionesController
{
    public function index(){
        $postulaciones = Postulacion::all();

        if($postulaciones->isEmpty()){
            $data = [
                "mensaje" => "No hay postulaciones disponibles",
                "estatus" => 404
            ];
            
            return response()->json($data , 404);
        }

        $data = [
            "mensaje" => "Lista de postulaciones",
            "estatus" => 200,
            "postulaciones" => $postulaciones
        ];
        
        return response()->json($postulaciones , 200); 
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all(), [ 
            "alumno_id" => "required",
            "vacante_id" => "required",
            "estatus" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                'mensaje' => 'La validacion fallo',
                'error' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }


        $postulacion = Postulacion::create([
            "alumno_id" => $request->alumno_id,
            "vacante_id" => $request->vacante_id,
            "estatus" => $request->estatus
        ]);

        $data = [
            "mensaje" => "La postulacion fue creada correctamente",
            "estatus" => 200,
            "postulacion" => $postulacion
        ];

        return response()->json($data , 200);
    }

    public function update(Request $request , $id){
        $validacion = Validator::make($request->all(), [ 
            "estatus" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                'mensaje' => 'La validacion fallo',
                'error' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $postulacion = Postulacion::find($id);

        if(!$postulacion){
            $data = [
                'mensaje' => 'Postulacion no encontrada',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $postulacion->estatus = $request->estatus;

        $postulacion->save();

        $data = [
            "mensaje" => "Postulacion actualizada correctamente",
            "estatus" => 200
        ];

        return response()->json($data , 200);
    }

    public function destroy(Request $request , $id){
        $postulacion = Postulacion::find($id);

        if(!$postulacion){
            $data = [
                "mensaje" => "Postulacion no encontrada",
                "estatus" => 404
            ];

            return response()->json($data , 404);
        }

        $postulacion->delete();

        
        $data = [
            "mensaje" => "Postulacion eliminada correctamente",
            "estatus" => 200
        ];

        return response()->json($data , 200);
    }
    
}
