<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaplaceController extends Controller
{
    public function index()
    {
        $fechas = DB::table('postulaciones')
            ->select(DB::raw('DATE(created_at) as fecha'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderByRaw('fecha ASC')
            ->get();
    
        
        if ($fechas->isEmpty()) {
            return response()->json([
                "mensaje" => "No hay postulaciones registradas",
                "estatus" => 404
            ], 404);
        }
    

        
        $alpha = 0.4; // Factor de suavizado (ajustable de 0.1 a 0.9)
        $valorSuavizadoAnterior = 0;
        $datosProcesados = [];
    
        foreach ($fechas as $registro) {
            // Implementación de la ecuación de diferencias:
            // y[n] = α * x[n] + (1 - α) * y[n-1]
            $actualSuavizado = ($alpha * $registro->total) + ((1 - $alpha) * $valorSuavizadoAnterior);
            
            $datosProcesados[] = [
                "fecha" => $registro->fecha,
                "valor_real" => $registro->total,
                "valor_laplace" => round($actualSuavizado, 2) 
            ];
    
            $valorSuavizadoAnterior = $actualSuavizado;
        }
    
        return response()->json([
            "mensaje" => "Análisis de tendencias generado exitosamente",
            "estatus" => 200,
            "data" => $datosProcesados
        ], 200);
    }
}
