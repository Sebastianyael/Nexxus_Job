<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recomendaciones;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RecomendacionesController extends Controller
{
    public function index($id){
        $recomendaciones = Recomendaciones::with('alumnoInfo.usuario')->where('instructor_id' , $id)->get();

        if(!$recomendaciones){
            $data = [
                'mensaje' => 'No hay recomendaciones registradas',
                'estatus' => 404
            ];

            return response()->json($data , 404);
        }


        $data = [
            'mensaje' => 'Lista de recomendaciones',
            'estatus' => 200,
            'recomendaciones' => $recomendaciones
        ];

        return response()->json($data , 200);
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all() , [
            'instructor_id' => 'required',
            'alumnos_id' => 'required',
            'comentario' => 'required' 
        ]);

        if($validacion->fails()){
            $data = [
                'mensaje' => 'Error en la validacion',
                'estatus' => 400,
                'error' => $validacion->errors()
            ];

            return response()->json($data , 400);
        }

        $recomendacion =  Recomendaciones::create([
            'instructor_id' => $request->instructor_id,
            'alumnos_id' => $request->alumnos_id,
            'comentario' => $request->comentario
        ]);

        $data = [
            'mensaje' => 'Recomendacion creada',
            'estatus' => 200,
            'recomendacion' => $recomendacion
        ];
        return response()->json($data , 200);
    }

    public function update(Request  $request , $id){
        $recomendacion = Recomendaciones::find($id);

        if(!$recomendacion){
            $data = [
                'mensaje' => 'Recomendacion no encontrada' , 
                'estatus' => 404
            ];

            return response()->json($data , 404);
        }

        $validacion = Validator::make($request->all() , [
            'comentario' => 'required' 
        ]);

        if($validacion->fails()){
            $data = [
                'mensaje' => 'Error en la validacion',
                'estatus' => 400,
                'error' => $validacion->errors()
            ];

            return response()->json($data , 400);
        }

        $recomendacion->comentario = $request->comentario;
        $recomendacion->save();

        $data = [
            'mensaje' => 'Recomendacion actualizaada',
            'estatus' => 200,
            'recomendacion' => $recomendacion
        ];

        return response()->json($data , 200);

    }

    public function destroy(Request $request , $id){
        $recomendacion = Recomendaciones::find($id);

        if(!$recomendacion){
            $data = [
                'mensaje' => "Recomendacion no encontrada",
                'estatus' => 404
            ];

            return response()->json($data , 404);
        }

        $recomendacion->delete();

        $data = [
            'mensaje' => 'Recomendacion eliminada',
            'estatus' => 200
        ];

        return response()->json($data,200);
    }
}
