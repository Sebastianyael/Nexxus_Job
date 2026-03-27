<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlumnoController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\RecomendacionesController;
use App\Http\Controllers\Api\VacantesController;
use App\Http\Controllers\Api\PostulacionesController;
use App\Http\Controllers\Api\CarrerasController;

use App\Http\Controllers\Api\LoginController;

Route::controller(CarrerasController::class)->group(function (){
    Route::get('carreras' , 'show');
});

Route::controller(LoginController::class)->group(function () {
    Route::post('login' , 'show');
});

Route::controller(AlumnoController::class)->group(function () {
    Route::get('usuarios/alumnos/{id}' , 'index' );
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
    Route::get('empresas/{id}' , 'index');
    Route::post('empresas', 'store');
    Route::put('empresas/{id}' , 'update');
    Route::delete('empresas/{id}' , 'destroy');
});

Route::controller(RecomendacionesController::class)->group(function(){
    Route::get('recomendaciones' , 'index');
    Route::post('recomendaciones' , 'store');
    Route::put('recomendaciones/{id}' , 'update');
    Route::delete('recomendaciones/{id}' , 'destroy');
});

Route::controller(VacantesController::class)->group(function(){
    Route::get('vacantes' , 'index');
    Route::get('vacantes/filtrar' , 'filtrar');
    Route::get('misVacantes/{id}' , 'misVacantes');
    Route::post('vacantes' , 'store');
    Route::put('vacantes/{id}' , 'update');
    Route::delete('vacantes/{id}' , 'destroy');   
});

Route::controller(PostulacionesController::class)->group(function(){
    Route::get('mispostulaciones/{id}' , 'index');
    Route::get('postulados/{id}' , 'vacantePostulados');
    Route::post('postulaciones' , 'store');
    Route::put('postulaciones/{id}' , 'update');
    Route::delete('postulaciones/{id}'  , 'destroy');
});