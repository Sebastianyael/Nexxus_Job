<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlumnoController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\EmpresaController;


Route::controller(AlumnoController::class)->group(function () {
    Route::get('usuarios/alumnos' , 'index' );
    Route::post('usuarios/alumnos' , 'store');
    Route::put('usuarios/alumnos/{id}' , 'update');
    Route::delete('usuarios/alumnos/{id}' , 'destroy');
});

Route::controller(InstructorController::class)->group(function (){
    Route::get('instructores' , 'index');
    Route::post('instructores' , 'store');
    Route::put('instructores/{id}' , 'update');
    Route::delete('instructores/{id}' , 'destroy');
});

Route::controller(EmpresaController::class)->group(function () {
    Route::get('empresas' , 'index');
    Route::post('empresas' , 'store');
    Route::put('empresas/{id}' , 'update');
    Route::delete('empresas/{id}' , 'destroy');
});