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
    public function index($id) {
 
        $alumno = Alumno::with(['usuario', 'carrera'])->find($id);
    
        if (!$alumno) {
            $data = [
                'mensaje' => 'No hay estudiante registrado con ese ID',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
    
      
        if ($alumno->curriculum) {
            $alumno->curriculum_url = asset('storage/' . $alumno->curriculum);
        } else {
            $alumno->curriculum_url = null;
        }
    
        $data = [
            'mensaje' => 'Informacion del Alumno',
            'status' => 200,
            'alumno' => $alumno,
        ];
    
        return response()->json($data, 200);
    }
    public function store(Request $request){

        $validacion = Validator::make($request->all(), [
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
            'curriculum' => 'nullable|mimes:pdf|max:2048', 
            "carrera_id" => "required",
        ]);
    
        if($validacion->fails()){
            $data = [
                'mensaje' => 'La validacion fallo',
                'error' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
    
        } else {
           
            $path = null;
    
         
            if ($request->hasFile('curriculum')) {
               
                $path = $request->file('curriculum')->store('cvs', 'public');
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
    
            $alumno = Alumno::create([
                "matricula" => $request->matricula,
                "curriculum" => $path, 
                "carrera_id" => $request->carrera_id,
                "usuario_id" => $usuario->id
            ]);
            
            $alumno->info = $usuario; 
    
            $alumno->curriculum_url = asset('storage/' . $alumno->curriculum);

            $data = [
                "mensaje" => "Alumno registrado correctamente",
                "estatus" => 200,
                "alumno" => $alumno, 
            ];
            
            return response()->json($data, 200);
        }
    }
    public function update(Request $request,$id){
        $alumno  = Alumno::with(['usuario', 'carrera'])->where('id' , $id)->first();
       
        if(!$alumno){
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
     

            $alumno->matricula = $request->matricula;
            $alumno->curriculum = $request->curriculum;
            $alumno->carrera_id = $request->carrera_id;
            $alumno->usuario->nombre = $request->nombre;
            $alumno->usuario->apellido_p = $request->apellido_p;
            $alumno->usuario->apellido_m = $request->apellido_m;
            $alumno->usuario->email = $request->email;
            $alumno->usuario->telefono = $request->telefono;
            $alumno->usuario->contraseña = $request->contraseña;
            $alumno->usuario->fecha_nacimiento = $request->fecha_nacimiento;
            $alumno->usuario->genero = $request->genero;
            $alumno->push();
            
          
            $alumno->load('carrera');
            $data = [
                "mensaje" => "Alumno actualizado correctamente",
                "estatus" => 200,
                "alumno" => $alumno,
               
                
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
