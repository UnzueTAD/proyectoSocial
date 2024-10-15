<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud; // Importa el modelo Solicitud
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudController extends Controller
{
    /**
     * Muestra una lista de recursos con filtrado opcional.
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
        $localidad = $request->query('localidad');
        $contacto = $request->query('contacto');
        $motivo_solicitud = $request->query('motivo_solicitud');
        $id = $request->query('id');
        
        // Construir la consulta
        $query = Solicitud::query();

        if ($sector) {
            $query->where('sector', $sector);
        }

        if ($rut && $digito_verificador) {
            $query->where('rut', $rut)
                  ->where('digito_verificador', $digito_verificador);
        }

        if ($id) {
            $query->where('id', $id);
        }

        // Obtener las solicitudes filtradas o todas si no hay filtros
        $solicitudes = $query->get();

        return response()->json($solicitudes);
    }

    /**
     * Almacena una nueva solicitud.
     */
    public function store(Request $request)
    {

        // return response()->json($request);
        // Validar los datos que llegan del frontend
        // $validatedData = $request->validate([
        //     'nombre_completo' => 'required|string|max:255',
        //     'rut' => 'required|string|max:12',
        //     'digito_verificador' => 'required|string|max:2',
        //     'fecha_solicitud' => 'required|date',
        //     'sector' => 'required|string|max:255',
        //     'motivo_solicitud' => 'required|string',
        //     'contacto' => 'required|string',
        //     'estado_solicitud' => 'string',
        //     'localidad' => 'required|string|max:255',
        // ]);


        $formData = [
            'nombre_completo' => $request->nombre_completo,
            'rut' => $request->rut,
            'digito_verificador' => $request->digito_verificador,
            'fecha_solicitud' => $request->fecha_solicitud,
            'sector' => $request->sector,
            'motivo_solicitud' => $request->motivo_solicitud,
            'contacto' => $request->contacto,
            'localidad' => $request->localidad,
            'estado_solicitud' => $request->estado
        ];

        //return response()->json(['data desde laravel: ' => $formData]);

        Solicitud::updateOrCreate($formData);

        return response()->json(['message' => 'Datos guardados correctamente']);

        // Crear la nueva solicitud
        // $solicitud = Solicitud::create($validatedData);

        // return response()->json($solicitud, 201);
    }

    /**
     * Muestra una solicitud específica.
     */
    public function show($id)
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
     * Actualiza una solicitud existente.
     */
    public function update(Request $request, $id)
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
            'nombre_completo' => 'sometimes|required|string|max:255',
            'rut' => 'sometimes|required|string|max:12',
            'digito_verificador' => 'sometimes|required|string|max:2',
            'motivo_solicitud' => 'sometimes|required|string',
            'fecha_solicitud' => 'sometimes|required|date',
            'sector' => 'sometimes|required|string|max:255',
            'estado_solicitud' => 'sometimes|required|string|max:255',
            'contacto' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
        ]);

        // Actualizar la solicitud
        $solicitud->update($validatedData);

        return response()->json([
            'message' => 'Solicitud actualizada con éxito',
            'data' => $solicitud
        ]);
    }

    /**
     * Elimina una solicitud.
     */
    public function destroy($id)
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

        return response()->json([
            'message' => 'Solicitud eliminada con éxito'
        ]);
    }

    /**
     * Genera un PDF de una solicitud específica.
     */
    // public function generarPDF($id)
    // {
    //     $solicitud = Solicitud::findOrFail($id);  // Busca la solicitud por ID
        
    //     // Carga la vista 'pdf' con los datos de la solicitud
    //     $pdf = PDF::loadView('pdf', compact('solicitud'));
        
    //     // Retorna el PDF generado como respuesta para ser descargado
    //     return $pdf->download('solicitud_' . $solicitud->id . '.pdf');
    // }
    public function generatePDF($id)
    {
        // Buscar la solicitud por ID
        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return response()->json(['message' => 'Solicitud no encontrada'], 404);
        }

        // Cargar una vista para el PDF con los datos de la solicitud
        $pdf = Pdf::loadView('pdf.solicitud', compact('solicitud'));

        // Devolver el PDF como respuesta para descargar
        return $pdf->download("solicitud_{$id}.pdf");
    }
}
