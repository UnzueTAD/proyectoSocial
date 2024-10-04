<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mostrarUsuarios()
    {
        $users = User::all(); // Obtenemos todos los usuarios de la tabla 'users'
        return response()->json($users); // Retornamos los usuarios en formato JSON
    }
    public function store(Request $request)
{
    // Validar los datos
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'role_id' => 'required|exists:roles,id', // Validar que el rol exista
    ]);

    // Crear un nuevo usuario
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']), // Hashear la contraseña
        'role_id' => $validatedData['role_id'], // Asignar el rol
    ]);
    

    return response()->json(['message' => 'Usuario creado con éxito', 'data' => $user], 201);
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!auth()->attempt($credentials)) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    $user = auth()->user();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
}

}
