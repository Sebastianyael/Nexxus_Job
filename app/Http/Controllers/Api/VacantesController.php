<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacantes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VacantesController extends Controller
{
    public function filtrar(Request $request) 
        {
            $query = Vacantes::with('empresa');

            $query->when($request->genero, function ($q) use ($request) {
                return $q->where('genero', $request->genero);
            });

            $query->when($request->tiempo, function ($q) use ($request) {
                return $q->where('tiempo', $request->tiempo);
            });

            $query->when($request->jornada, function ($q) use ($request) {
                return $q->where('jornada', $request->jornada);
            });

            $query->when($request->modalidad, function ($q) use ($request) {
                return $q->where('modalidad', $request->modalidad);
            });
            $vacantes = $query->latest()->get();
            return response()->json([
                "mensaje" => "Lista de vacantes filtrada",
                "estatus" => 200,
                "vacantes" => $vacantes
            ], 200);
        }

    public function misVacantes($id){
        $vacantes = Vacantes::where('empresa_id' , $id)->get();

        if($vacantes -> isEmpty()){
            $data = [
                "mensaje" => "No hay vacantes existentes",
                "estatus" => 404
            ];

            return response()->json($data , 404);
        }

        $data = [
            "mensaje" => "Lista de vacantes",
            "estatus" => 200,
            "vacantes" => $vacantes
        ];

        return response()->json($data , 200);
    }


    public function index(){
        $vacantes = Vacantes::with('empresa')->get();

        if($vacantes -> isEmpty()){
            $data = [
                "mensaje" => "No hay vacantes existentes",
                "estatus" => 404
            ];

            return response()->json($data , 404);
        }

        $data = [
            "mensaje" => "Lista de vacantes",
            "estatus" => 200,
            "vacantes" => $vacantes
        ];

        return response()->json($data , 200);
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all() , [
            "requisitos" => "required",
            "genero" => "required",
            "tiempo" => "required",
            "modalidad" => "required",
            "jornada" => "required",
            "fecha_de_expiracion" => "required",
            "descripcion" => "required",
            "titulo" => "required",
            "empresa_id" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "Error en la validacion",
                "estatus" => 400,
                "error" => $validacion->errors()
            ];

            return response()->json($data , 400);
        }

        $vacante = Vacantes::create([
            "requisitos" => $request->requisitos,
            "fecha_de_expiracion" => $request->fecha_de_expiracion,
            "descripcion" => $request->descripcion,
            "titulo" => $request->titulo,
            "empresa_id" =>  $request->empresa_id,
            "genero" => $request->genero,
            "tiempo" => $request->tiempo,
            "modalidad" => $request->modalidad,
            "jornada" => $request->jornada
 
        ]);

        $data = [
            "mensaje" => "Vacante registrada con exito",
            "estatus" => 200,
            "vacante" => $vacante
        ];

        return response()->json($data , 200);

    }

    public function update(Request $request , $id){
        $vacante = Vacantes::find($id);

        if(!$vacante){
            $data = [
                "mensaje" => "Vacante no encontrada",
                "estatus" => 404
            ];

            return response()->json($data , 404);
        }

        $validacion = Validator::make($request->all() , [
            "requisitos" => "required",

            "fecha_de_expiracion" => "required",
            "descripcion" => "required",
            "titulo" => "required",
            "empresa_id" => "required",
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "Error en la validacion",
                "estatus" => 400,
                "error" => $validacion->errors()
            ];

            return response()->json($data , 400);
        }

        $vacante->requisitos = $request->requisitos;
    
        $vacante->fecha_de_expiracion = $request->fecha_de_expiracion;
        $vacante->descripcion = $request->descripcion;
        $vacante->titulo = $request->titulo;
        $vacante->genero = $request->genero;
        $vacante->modalidad = $request->modalidad;
        $vacante->jornada = $request->jornada;
        $vacante->tiempo = $request->tiempo;
        $vacante->save();

        $data = [
            "mensaje" => "Vacante actualizada con exito",
            "estatus" => 200,
            "vacante" => $vacante     
        ];

        return response()->json($data , 200);
    }

    public function destroy(Request $request , $id){
        $vacante = Vacantes::find($id);

        if(!$vacante){
            $data = [
                "mensaje" => "Vacante no encontrada",
                "estatus" => 404
            ];

            return response()->json($data , 404);
        }

        $vacante->delete();

        $data = [
            "mensaje" => "Vacante eliminada",
            "estatus" => 200
        ];

        return response()->json($data , 200);

    }
}
