<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\EstadoSolicitudController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas para Solicitud utilizando el controlador de tipo resource
//Route::apiResource('solicitudes', SolicitudController::class);

Route::apiResource('solicitudes', SolicitudController::class);

Route::get('solicitudes/pdf/{id}', [SolicitudController::class, 'generarPDF']);

// Rutas adicionales para UserController o cualquier otro controlador
// Puedes definir aquí más rutas según sea necesario.

//APARTADO LOGGIN CON API PROTEGIDOS CON EL MÉTODO SANCTUM

Route::middleware('auth:sanctum')->group(function () {
    // Rutas protegidas
    // Route::post('/usuarios', [UserController::class, 'store']);  // Crear usuario
    // Route::apiResource('solicitudes', SolicitudController::class);
    Route::get('/usuarios', [UserController::class, 'mostrarUsuarios']);
    Route::post('/logout', [AuthController::class, 'logout']);   // Listar usuarios
});

// Route::post('/login', [UserController::class, 'login']); // Ruta para login
// Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum'); // Ruta para logout (protegida)

//FIN APARTADO LOGGIN

//Route::get('/users', [UserController::class, 'index']);
//Route::post('/users', [UserController::class, 'store']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);