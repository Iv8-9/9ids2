<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\asistenciaController;
use App\Http\Controllers\membresiaController;
use App\Http\Controllers\tipo_membresiaController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\clasesController;
use App\Http\Controllers\sucursalesController;
use App\Http\Controllers\PokemonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[LoginController::class, 'login']);

//ASISTENCIAS
Route::post('asistencias', [asistenciaController::class, 'list']);
Route::get('asistencia/{id}', [asistenciaController::class, 'index']);
Route::post('asistencia/nuevo', [asistenciaController::class, 'store']);
Route::post('asistencia/eliminar', [asistenciaController::class, 'destroy']);


//MEMBRESIAS
Route::post('membresias', [membresiaController::class, 'list']);
Route::get('membresia/{id}', [membresiaController::class, 'index']);
Route::post('membresia/nuevo', [membresiaController::class, 'store']);
Route::post('membresia/eliminar', [membresiaController::class, 'destroy']);

//TIPO MEMBRESIAS
Route::post('tipo_membresias', [tipo_membresiaController::class, 'list']);
Route::get('tipo_membresia/{id}', [tipo_membresiaController::class, 'index']);
Route::post('tipo_membresia/nuevo', [tipo_membresiaController::class, 'store']);
Route::post('tipo_membresia/eliminar', [tipo_membresiaController::class, 'destroy']);

//PERSONAS
Route::post('personas', [usuariosController::class, 'list']);
Route::get('persona/{id}', [usuariosController::class, 'index']);
Route::post('persona/nuevo', [usuariosController::class, 'store']);
Route::post('persona/roles', [usuariosController::class, 'roles']);
Route::post('persona/eliminar', [usuariosController::class, 'destroy']);

//CLASES
Route::post('clases', [clasesController::class, 'list']);
Route::get('clase/{id}', [clasesController::class, 'index']);
Route::get('clase/alumno/{id}', [clasesController::class, 'clase']);
Route::post('clase/nuevo', [clasesController::class, 'store']);
Route::post('clase/eliminar', [clasesController::class, 'destroy']);

//SUCURSALES
Route::post('sucursales', [sucursalesController::class, 'list']);
Route::get('sucursal/{id}', [sucursalesController::class, 'index']);
Route::post('sucursal/nuevo', [sucursalesController::class, 'store']);
Route::post('sucursal/eliminar', [sucursalesController::class, 'destroy']);

//Route::post('membresias', [membresiaController::class, 'list'])->middleware('auth:sanctum');
//Route::post('membresia', [membresiaController::class, 'index'])->middleware('auth:sanctum');
//Route::post('membresia/nuevo', [membresiaController::class, 'store'])->middleware('auth:sanctum');
//Route::post('membresia/eliminar/', [membresiaController::class, 'destroy'])->middleware('auth:sanctum');
////api


Route::get('/pokemon', [PokemonController::class, 'index']);
Route::get('/pokemon/{identifier}', [PokemonController::class, 'show']);