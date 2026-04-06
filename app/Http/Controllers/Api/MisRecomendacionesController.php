<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recomendaciones;
use App\Models\Instructor;
class MisRecomendacionesController extends Controller
{
    public function recomendaciones($id){
        $recomendaciones = Recomendaciones::with(['instructorInfo.usuarios'])->where('alumnos_id' , $id)->get();
       

        if(!$recomendaciones){
            $data = [
                "mensaje" => "El alumno no tiene recomendaciones" ,
                "estatus" => 404, 
                
            ];    

            return response()->json($data , 404);
        }

        $data = [
            "mensaje" => "Lista de recomendaciones del alumno" ,
            "estatus" => 200, 
            "recomendaciones" => $recomendaciones
        ];

        return response()->json($data , 200);
    }
}
