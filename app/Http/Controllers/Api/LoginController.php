<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function show(Request $request)
    {
   
        $usuario = Usuario::where('email', $request->email)->first();

        if ($usuario) {
            if ($usuario->contraseña == $request->contraseña) {
                return response()->json([
                    "mensaje" => "Bienvenido",
                    "tipo"    => $usuario->tipo,
                    "estatus" => 200
                ], 200);
            } else {
                return response()->json([
                    "mensaje" => "Contraseña incorrecta",
                    "estatus" => 400
                ], 400);
            }
        }


        $empresa = Empresa::where('email', $request->email)->first(); 

        if ($empresa) {
            if ($empresa->contraseña == $request->contraseña) {
                return response()->json([
                    "mensaje" => "Bienvenido",
                    "tipo"    => $empresa->tipo,
                    "estatus" => 200
                ], 200);
            } else {
                return response()->json([
                    "mensaje" => "Contraseña incorrecta",
                    "estatus" => 400
                ], 400);
            }
        }


        return response()->json([
            "mensaje" => "Usuario o Empresa no encontrado",
            "estatus" => 404
        ], 404);
    }
}