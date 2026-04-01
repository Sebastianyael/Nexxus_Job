<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function index($id){
        $instructores = Instructor::with(['usuarios' , 'puesto'])->where('id_usuario' , $id)->first();

        if(!$instructores){
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
            "email" => "required",
            "telefono" => "required",
            "contraseña" => "required",
            "fecha_nacimiento" => "required",
            "genero" => "required",
            "tipo" => "required",
            "no_empleado" => "required",
            "id_puesto" => "required",
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "La validacion fallo",
                'error' => $validacion->errors(),  
                "estatus" => 400
            ];

            return response() -> json($data,400);
        }

        $usuario = Usuario::create([
            "nombre" => $request->nombre,
            "apellido_p" => $request->apellido_p,
            "apellido_m" => $request->apellido_m,
            "email" => $request->email,
            "telefono" => $request->telefono,
            "contraseña" => $request->contraseña,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "genero" => $request->genero,
            "tipo" => $request->tipo
        ]);

        if(!$usuario){
            $data = [
                "mensaje" => "error en el registro de usuario",
                "estatus" =>400
            ];

            return response()->json($data , 400);
        }else{
            $instructor = Instructor::create([
                "no_empleado" => $request->no_empleado,
                "id_puesto" => $request->id_puesto,
                "id_usuario" => $usuario->id
            ]); 
        }

        $data = [
            "mensaje" => "Instructor registrado correctamente",
            "estatus" => 200
        ];
        return response()->json($data,200);
    }

    public function update(Request $request, $id){
        $usuario = Usuario::find($id);
        
        if(!$usuario){
            $data = [
                "mensjae" => "Usuario no encontrado",
                "estatus" => 404
             ];

             return response()->json($data , 404);
        }



        $validacion = Validator::make($request->all() , [
            "nombre" => "required",
            "apellido_p" => "required",
            "apellido_m" => "required",
            "email" => "required",
            "telefono" => "required",
            "contraseña" => "required",
            "fecha_nacimiento" => "required",
            "genero" => "required",
            "tipo" => "required",
            "no_empleado" => "required",
            "id_puesto" => "required",
        ]);

        if($validacion->fails()){
            $data = [
                "mensaje" => "Errror en la validacion",
                "estatus" => 400
            ];

            return response()->json($data , 400);
        }

   

        $usuario->nombre = $request->nombre;
        $usuario->apellido_p = $request->apellido_p;
        $usuario->apellido_m = $request->apellido_m;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->contraseña = $request->contraseña;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero = $request->genero;

        $usuario->save();

        DB::table('instructores')
            ->where('id_usuario' , $id)
            ->update([
                "no_empleado" => $request->no_empleado,
                "id_puesto" => $request->id_puesto
            ]);


        $data = [
            "mensaje" => "Instructor actualizado correctamente",
            "estatus" => 200,
            "instructor" => $usuario

        ];

        return response()->json($data , 200);
    }

    public function destroy(Request $request , $id){
        $instructor = Instructor::where('id_usuario' , $id)->first();
        $usuario = Usuario::find($id);
        
        if(!$usuario){
            $data = [
                "mensaje" => "Usario no encontrado",
                "estatus" => 404

            ];

            return response()->json($data,404);
        }else{
            $instructor->delete();
            $usuario->delete();
        }

        $data = [
            "mensaje" => "Instructor eliminado correctamente",
            "estatus" => 200
        ];

        return response()->json($data , 200);

    }
}