<?php

namespace App\Http\Controllers;

use App\Models\EstadoSolicitud;
use Illuminate\Http\Request;

class EstadoSolicitudController extends Controller
{
    // Mostrar todos los estados de solicitud
    public function index()
    {
        return response()->json(EstadoSolicitud::all());
    }

    // Almacenar un nuevo estado de solicitud
    public function store(Request $request)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'ingresado' => 'nullable|string',
            'pendiente' => 'nullable|string',
            'rechazado' => 'nullable|string'
        ]);

        // Crear un nuevo estado de solicitud
        $estadoSolicitud = EstadoSolicitud::create($validatedData);

        // Responder con éxito
        return response()->json(['message' => 'Estado de solicitud creado con éxito', 'data' => $estadoSolicitud], 201);
    }

    // Mostrar un estado de solicitud específico
    public function show($id)
    {
        $estadoSolicitud = EstadoSolicitud::find($id);

        if (!$estadoSolicitud) {
            return response()->json(['message' => 'Estado de solicitud no encontrado'], 404);
        }

        return response()->json($estadoSolicitud);
    }

    // Actualizar un estado de solicitud específico
    public function update(Request $request, $id)
    {
        $estadoSolicitud = EstadoSolicitud::find($id);

        if (!$estadoSolicitud) {
            return response()->json(['message' => 'Estado de solicitud no encontrado'], 404);
        }

        // Validar los datos del request
        $validatedData = $request->validate([
            'ingresado' => 'nullable|string',
            'pendiente' => 'nullable|string',
            'rechazado' => 'nullable|string'
        ]);

        // Actualizar el estado de solicitud
        $estadoSolicitud->update($validatedData);

        // Responder con éxito
        return response()->json(['message' => 'Estado de solicitud actualizado con éxito', 'data' => $estadoSolicitud]);
    }

    // Eliminar un estado de solicitud
    public function destroy($id)
    {
        $estadoSolicitud = EstadoSolicitud::find($id);

        if (!$estadoSolicitud) {
            return response()->json(['message' => 'Estado de solicitud no encontrado'], 404);
        }

        // Eliminar el estado de solicitud
        $estadoSolicitud->delete();

        // Responder con éxito
        return response()->json(['message' => 'Estado de solicitud eliminado con éxito']);
    }
}
