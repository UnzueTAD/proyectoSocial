<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    // Mostrar todos los sectores
    public function index()
    {
        return response()->json(Sector::all());
    }

    // Almacenar un nuevo sector
    public function store(Request $request)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'costa_norte' => 'nullable|string',
            'costa_sur' => 'nullable|string'
        ]);

        // Crear un nuevo sector
        $sector = Sector::create($validatedData);

        // Responder con éxito
        return response()->json(['message' => 'Sector creado con éxito', 'data' => $sector], 201);
    }

    // Mostrar un sector específico
    public function show($id)
    {
        $sector = Sector::find($id);

        if (!$sector) {
            return response()->json(['message' => 'Sector no encontrado'], 404);
        }

        return response()->json($sector);
    }

    // Actualizar un sector específico
    public function update(Request $request, $id)
    {
        $sector = Sector::find($id);

        if (!$sector) {
            return response()->json(['message' => 'Sector no encontrado'], 404);
        }

        // Validar los datos del request
        $validatedData = $request->validate([
            'costa_norte' => 'nullable|string',
            'costa_sur' => 'nullable|string'
        ]);

        // Actualizar el sector
        $sector->update($validatedData);

        // Responder con éxito
        return response()->json(['message' => 'Sector actualizado con éxito', 'data' => $sector]);
    }

    // Eliminar un sector
    public function destroy($id)
    {
        $sector = Sector::find($id);

        if (!$sector) {
            return response()->json(['message' => 'Sector no encontrado'], 404);
        }

        // Eliminar el sector
        $sector->delete();

        // Responder con éxito
        return response()->json(['message' => 'Sector eliminado con éxito']);
    }
}
