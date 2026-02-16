<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Alumno;
    use App\Models\Usuario;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function index(){
        $alumnos = Alumno::with('usuario')->first();

        if(!$alumnos){
            $datos = [
                'mensaje' => 'No hay estudiantes registrados',
                'status' => 404
            ];

            return response()->json($datos , 404);
        }

        return response()->json($alumnos , 200);
        
    }

    public function store(Request $request){

        $validacion = Validator::make($request -> all() , [
            "nombre" => "required",
            "apellido_p" => "required",
            "apellido_m" => "required",
            "email" => "required",
            "telefono" => "required",
            "contraseña" => "required",
            "fecha_nacimiento" => "required",
            "genero" => "required",
            "tipo" => "required",
            "matricula" => "required",
            "curriculum" => "required",
            "carrera_id" => "required",
        ]);

        if($validacion->fails()){
            $data = [
                'mensaje' => 'La validacion fallo',
                'error' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data,400);

        }else{
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



            $alumno = Alumno::create([
                "matricula" => $request->matricula,
                "curriculum" => $request->curriculum,
                "carrera_id" => $request->carrera_id,
                "usuario_id" => $usuario->id
            ]);
            
            return response()->json(['mensaje' => 'El alumno fue creado correctamente' , 'status' => 200], 200);
        }
    }

    public function update(Request $request,$id){
        $usuario = Usuario::find($id);
        if(!$usuario){
            $data = [
                "mensaje" => "Usuario no encontrado",
                "estatus" => 404
            ];

            return response()->json($data,404);
        }

        $validacion = Validator::make($request -> all() , [
            "nombre" => "required",
            "apellido_p" => "required",
            "apellido_m" => "required",
            "email" => "required",
            "telefono" => "required",
            "contraseña" => "required",
            "fecha_nacimiento" => "required",
            "genero" => "required",
            "tipo" => "required",
            "matricula" => "required",
            "curriculum" => "required",
            "carrera_id" => "required",
        ]);
        
        if($validacion->fails()){
            $data = [
                'mensaje' => 'La validacion fallo',
                'error' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }else{
            $usuario->nombre = $request->nombre;
            $usuario->apellido_p = $request->apellido_p;
            $usuario->apellido_m = $request->apellido_m;
            $usuario->email = $request->email;
            $usuario->telefono = $request->telefono;
            $usuario->contraseña = $request->contraseña;
            $usuario->fecha_nacimiento = $request->fecha_nacimiento;
            $usuario->genero = $request->genero;
            $usuario->save();

            DB::table('alumnos')
            ->where('usuario_id', $id)
            ->update([
                'matricula'  => $request->matricula,
                'curriculum' => $request->curriculum,
                'carrera_id' => $request->carrera_id,
            ]);

            $data = [
                "mensaje" => "Estudiante actualizado correctamente",
                "estatus" => 200,
            ];
            return response()->json($data,200);
        }
    }

    public function destroy(Request $request , $id){
        $alumno = Alumno::where('usuario_id' , $id)->first();
        $alumno->delete();
        $usuario = Usuario::find($id);

        if(!$usuario){
            $data = [
                "Mensaje" => "Alumno no encontrado",
                "Estatus" => 404
            ];
            return response()->json($data,404);
        }
        $usuario->delete();

        $data = [ 
            "mensaje" => "Alumno eliminado correctamente",
            "status" => 200
        ];

        return response()->json($data,200);

    }
  
}
