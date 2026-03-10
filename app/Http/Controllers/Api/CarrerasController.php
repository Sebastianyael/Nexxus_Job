<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Carrera;


class CarrerasController extends Controller
{
   public function show(){
        $carreras = Carrera::all();

        if($carreras->isEmpty()){
            $data = [
                "mensaje" => "No hay carreras registradas",
                "estatus" => 404
            ];

            return response()->json($data , 404);
        }

        $data = [
            "mensaje" => "Lista de carreras",
            "estatus" => 200,
            "carreras" => $carreras
        ];

        return response()->json($data , 200);
   }
}
