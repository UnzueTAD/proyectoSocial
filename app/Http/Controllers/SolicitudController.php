<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud; // Asegúrate de importar el modelo Solicitud
use Barryvdh\DomPDF\Facade as PDF;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     * You can pass optional query parameters.
     */
    public function index(Request $request)
{
    // Obtener los parámetros de consulta
    $sector = $request->query('sector');
    $estado_solicitud = $request->query('estado_solicitud');
    $rut = $request->query('rut');
    $digito_verificador = $request->query('digito_verificador');
    $nombre_completo = $request->query('nombre_completo');
    $fecha_solicitud = $request->query('fecha_solicitud');
    $id = $request->query('id');
    // Construir la consulta dependiendo de los parámetros
    $query = Solicitud::query();

    if ($sector) {
        $query->where('sector', $sector);
    }

    if ($estado_solicitud) {
        $query->where('estado_solicitud', $estado_solicitud);
    }

    if ($rut && $digito_verificador) {
        // Buscar por RUT y dígito verificador
        $query->where('rut', $rut)
                ->where('digito_verificador', $digito_verificador);
    }

    // if ($nombre_completo) {
    //     // Usamos 'like' para hacer una búsqueda más flexible por nombre
    //     $query->where('nombre_completo', 'like', '%' . $nombre_completo . '%');
    // }

    if ($fecha_solicitud) {
        $query->whereDate('fecha_solicitud', $fecha_solicitud);
    }
    if ($id) {
        $query->where('id', $id);
    }

    // Obtener todas las solicitudes (o filtradas si se pasa algún parámetro)
    $solicitudes = $query->get();

    // Retornar respuesta JSON con las solicitudes
    return response()->json($solicitudes);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar los datos que llegan del frontend
    $validatedData = $request->validate([
        'nombre_completo' => 'required|string|max:255',
        'rut' => 'required|string|max:12',
        'digito_verificador' => 'required|string|max:2',
        'fecha_solicitud' => 'required|date',
        'sector' => 'required|string|max:255',
        'motivo_solicitud' => 'required|string',
        'departamento' => 'required|string',
        'estado_solicitud' => 'required|string',
        'localidad' => 'required|string|max:255'
    ]);

    // Crear la nueva solicitud
    $solicitud = Solicitud::create($validatedData);

    // Retornar la respuesta
    return response()->json($solicitud, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar la solicitud por ID
        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return response()->json([
                'message' => 'Solicitud no encontrada'
            ], 404);
        }

        return response()->json($solicitud);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Buscar la solicitud por ID
        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return response()->json([
                'message' => 'Solicitud no encontrada'
            ], 404);
        }

        // Validar los datos, la restricción unique en el RUT no aplica aquí para este caso
        $validatedData = $request->validate([
            'nombre_completo' => 'sometimes|required|string',
            'rut' => 'sometimes|required|string',
            'digito_verificador' => 'sometimes|required|string',
            'motivo_solicitud' => 'sometimes|required|string',
            'fecha_solicitud' => 'sometimes|required|date',
            'sector' => 'sometimes|required|string',
            'estado_solicitud' => 'sometimes|required|string',
        ]);

        // Actualizar la solicitud
        $solicitud->update($validatedData);

        // Respuesta JSON de éxito
        return response()->json([
            'message' => 'Solicitud actualizada con éxito',
            'data' => $solicitud
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar la solicitud por ID
        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return response()->json([
                'message' => 'Solicitud no encontrada'
            ], 404);
        }

        // Eliminar la solicitud
        $solicitud->delete();

        // Respuesta JSON de éxito
        return response()->json([
            'message' => 'Solicitud eliminada con éxito'
        ]);
    }
    // Método para generar el PDF de una solicitud
    public function generarPDF($id)
    {
        $solicitud = Solicitud::findOrFail($id);  // Busca la solicitud por ID
        
        // Carga la vista pdf.blade.php con los datos de la solicitud
        $pdf = PDF::loadView('pdf', compact('solicitud'));
        
        // Retorna el PDF generado como respuesta para ser descargado
        return $pdf->download('solicitud_' . $solicitud->id . '.pdf');
    }
}
