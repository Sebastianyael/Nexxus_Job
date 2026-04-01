<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Puesto;
use App\Http\Controllers\Controller;
class PuestosController extends Controller
{
  
    public function index()
    {
        $puestos = Puesto::all();

        return response()->json($puestos , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
