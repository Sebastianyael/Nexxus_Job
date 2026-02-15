<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    public function index(){
        $instructores = Instructor::all();

        if($instructores -> isEmpty()){
            $data = [
                "mensaje" => "No hay instructores registrados",
                "estatus" => 404
            ];

            return response()->json($data,404);
        }

        $data = [
            "mensaje" => "Lista de instructores registrados",
            "estatus" => 200,
            "instructores" => $instructores
        ];

        return response()->json($data,200);
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all() , [
            "nombre" => "required",
            "apellido_p" => "required",
            "apellido_m" => "required",
            "no_empleado" => "required",
            "telefono" => "required",
            "email" => "required",
            "contraseña" => "required",
            "cargo" => "required",
            "fecha_nacimiento" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "La validacion fallo",
                'error' => $validacion->errors(),  
                "estatus" => 400
            ];

            return respose() -> json($data,400);
        }

        $instructor = Instructor::create([
            "nombre" => $request->nombre,
            "apellido_p" => $request->apellido_p,
            "apellido_m" => $request->apellido_m,
            "no_empleado" => $request->no_empleado,
            "telefono" => $request->telefono,
            "email" => $request->email,
            "contraseña" => $request->contraseña,
            "cargo" => $request->cargo,
            "fecha_nacimiento" => $request->fecha_nacimiento
        ]);

        $data = [
            "mensaje" => "Instructor registrado correctamente",
            "estatus" => 200
        ];
        return response()->json($data,200);
    }

    public function update(Request $request, $id){
        $instructor = Instructor::find($id);

        $validacion = Validator::make($request->all() , [
            "nombre" => "required",
            "apellido_p" => "required",
            "apellido_m" => "required",
            "no_empleado" => "required",
            "telefono" => "required",
            "email" => "required",
            "contraseña" => "required",
            "cargo" => "required",
            "fecha_nacimiento" => "required"
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "Errror en la validacion",
                "estatus" => 400
            ];

            return response()->json($data , 400);
        }

        $instructor->nombre = $request->nombre;
        $instructor->apellido_p = $request->apellido_p;
        $instructor->apellido_m = $request->apellido_m;
        $instructor->no_empleado = $request->no_empleado;
        $instructor->telefono = $request->telefono;
        $instructor->email = $request->email;
        $instructor->contraseña = $request->contraseña;
        $instructor->cargo = $request->cargo;
        $instructor->fecha_nacimiento = $request->fecha_nacimiento;

        $instructor->save();

        $data = [
            "mensaje" => "Instructor actualizado correctamente",
            "estatus" => 200,
            "instructor" => $instructor

        ];

        return response()->json($data , 200);
    }

    public function destroy(Request $request , $id){
        $instructor = Instructor::find($id);
        
        if(!$instructor){
            $data = [
                "mensaje" => "Instructor no encontrado",
                "estatus" => 404

            ];

            return response()->json($data,404);
        }

        $instructor->delete();

        $data = [
            "mensaje" => "Instructor eliminado correctamente",
            "estatus" => 200
        ];

        return response()->json($data , 200);

    }
}