<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $primaryKey = 'id_dep';
    protected $fillable = ['nombre_departamento'];

    // Definir la relación con las solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_dep');
    }
}
