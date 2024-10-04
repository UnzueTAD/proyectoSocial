<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los departamentos
        return response()->json(Departamento::all());
    }

    public function store(Request $request)
    {
        // Validar los datos del cuerpo de la solicitud
        $validatedData = $request->validate([
            'nombre_departamento' => 'required|string'
        ]);

        // Crear un nuevo departamento con los datos del cuerpo de la solicitud
        $departamento = Departamento::create([
            'nombre_departamento' => $request->input('nombre_departamento')
        ]);

        // Retornar una respuesta JSON de éxito
        return response()->json(['message' => 'Departamento creado con éxito', 'data' => $departamento], 201);
    }

    public function show(Request $request, $id)
    {
        // Buscar el departamento por ID
        $departamento = Departamento::find($id);
        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        return response()->json($departamento);
    }

    public function update(Request $request, $id)
    {
        // Buscar el departamento por ID
        $departamento = Departamento::find($id);
        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        // Validar los datos del cuerpo de la solicitud
        $validatedData = $request->validate([
            'nombre_departamento' => 'sometimes|required|string'
        ]);

        // Actualizar el departamento con los datos del cuerpo de la solicitud
        $departamento->update([
            'nombre_departamento' => $request->input('nombre_departamento')
        ]);

        // Responder con éxito
        return response()->json(['message' => 'Departamento actualizado con éxito', 'data' => $departamento]);
    }

    public function destroy($id)
    {
        // Buscar el departamento por ID
        $departamento = Departamento::find($id);
        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        // Eliminar el departamento
        $departamento->delete();

        // Responder con éxito
        return response()->json(['message' => 'Departamento eliminado con éxito']);
    }
}
