<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // Especificar los campos que pueden ser asignados masivamente
    protected $table='solicitudes';
    protected $fillable = [
        'nombre_completo',
        'rut',
        'digito_verificador',
        'motivo_solicitud',
        'fecha_solicitud',
        'sector',
        'estado_solicitud',
        'departamento',
    ];

    // Si la tabla no sigue la convención plural del nombre del modelo, puedes definirla aquí (opcional)
    // protected $table = 'nombre_tabla';
}
