<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{
    use HasFactory;

    protected $table = 'estado_solicituds';
    protected $primaryKey = 'id_estsol';
    protected $fillable = ['ingresado', 'pendiente', 'rechazado'];

    // Definir la relación con las solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_estsol');
    }
}
