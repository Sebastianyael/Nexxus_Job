<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlumnoController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\RecomendacionesController;

Route::controller(AlumnoController::class)->group(function () {
    Route::get('usuarios/alumnos' , 'index' );
    Route::post('usuarios/alumnos' , 'store');
    Route::put('usuarios/alumnos/{id}' , 'update');
    Route::delete('usuarios/alumnos/{id}' , 'destroy');
});

Route::controller(InstructorController::class)->group(function (){
    Route::get('usuarios/instructores' , 'index');
    Route::post('usuarios/instructores' , 'store');
    Route::put('usuarios/instructores/{id}' , 'update');
    Route::delete('usuarios/instructores/{id}' , 'destroy');
});

Route::controller(EmpresaController::class)->group(function () {
    Route::get('empresas' , 'index');
    Route::post('empresas' , 'store');
    Route::put('empresas/{id}' , 'update');
    Route::delete('empresas/{id}' , 'destroy');
});

Route::controller(RecomendacionesController::class)->group(function(){
    Route::get('recomendaciones' , 'index');
    Route::post('recomendaciones' , 'store');
    Route::put('recomendaciones/{id}' , 'update');
    Route::delete('recomendaciones/{id}' , 'destroy');
});