<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pruebaController;
use App\Http\Controllers\SolicitudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prueba', [pruebaController::class,'prueba']);
Route::get('/verDatos', [pruebaController::class,'verDatos']);



//Route::get('/solicitudes', [SolicitudController::class, 'index']);  // Obtener todas las solicitudes
//Route::post('/solicitudes', [SolicitudController::class, 'store']);  // Crear una nueva solicitud
//Route::get('/solicitudes/{id}', [SolicitudController::class, 'show']);  // Obtener una solicitud específica
//Route::put('/solicitudes/{id}', [SolicitudController::class, 'update']);  // Actualizar una solicitud existente
//Route::delete('/solicitudes/{id}', [SolicitudController::class, 'destroy']);  // Eliminar una solicitud
