<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumnos;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
{
    public function index(){
        $alumnos = Alumnos::all();

        if($alumnos -> isEmpty()){
            $datos = [
                'mensaje' => 'No hay estudiantes registrados',
                'status' => 404
            ];

            return response()->json($datos);
        }

        return response()->json($alumnos);
        
    }

    public function store(Request $request){

        $validacion = Validator::make($request -> all() , [
            'matricula' => 'required',
            'nombre' => 'required',
            'apellido_p' => 'required',
            'apellido_m' => 'required',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'carrera' => 'required',
            'email' => 'required',
            'contraseña' => 'required',
            'curriculumn' => 'required',
            'genero' => 'required'
        ]);

        if($validacion->fails()){
            $data = [
                'mensaje' => 'La validacion fallo',
                'error' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data,400);

        }else{
            $alumno = Alumnos::create([
                'matricula' => $request->matricula,
                'nombre' => $request->nombre,
                'apellido_p' => $request->apellido_p,
                'apellido_m' => $request->apellido_m,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'telefono' => $request->telefono,
                'carrera' => $request->carrera,
                'email' => $request->email,
                'contraseña' => $request->contraseña,
                'curriculumn' => $request->curriculumn,
                'genero' => $request->genero
            ]);
            
            return response()->json(['mensaje' => 'El alumno fue creado correctamente' , 'status' => 200], 200);
        }
    }

    public function update(Request $request,$id){
        $alumno = Alumnos::find($id);
        if(!$alumno){
            $data = [
                "mensaje" => "Estudiante no encontrado",
                "estatus" => 404
            ];

            return response()->json($data,404);
        }

        $validacion = Validator::make($request -> all() , [
            'matricula' => 'required',
            'nombre' => 'required',
            'apellido_p' => 'required',
            'apellido_m' => 'required',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'carrera' => 'required',
            'email' => 'required',
            'contraseña' => 'required',
            'curriculumn' => 'required',
            'genero' => 'required'
        ]);
        
        if($validacion->fails()){
            $data = [
                'mensaje' => 'La validacion fallo',
                'error' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }else{
            $alumno->matricula = $request->matricula;
            $alumno->nombre = $request->nombre;
            $alumno->apellido_p = $request->apellido_p;
            $alumno->apellido_m = $request->apellido_m;
            $alumno->fecha_nacimiento = $request->fecha_nacimiento;
            $alumno->telefono = $request->telefono;
            $alumno->carrera = $request->carrera;
            $alumno->email = $request->email;
            $alumno->contraseña = $request->contraseña;
            $alumno->curriculumn = $request->curriculumn;
            $alumno->genero = $request->genero;
            
            $alumno->save();
            $data = [
                "mensaje" => "Estudiante actualizado correctamente",
                "estatus" => 200,
                "Estudiante_actualizado" => $alumno
            ];
            return response()->json($data,200);
        }
    }

    public function destroy(Request $request , $id){
        $alumno = Alumnos::find($id);

        if(!$alumno){
            $data = [
                "Mensaje" => "Alumno no encontrado",
                "Estatus" => 404
            ];
            return response()->json($data,404);
        }

        $alumno->delete();

        $data = [ 
            "mensaje" => "Alumno eliminado correctamente",
            "status" => 200
        ];

        return response()->json($data,200);

    }
  
}
