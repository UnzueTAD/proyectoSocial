<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectores';
    protected $primaryKey = 'id_sector';
    protected $fillable = ['costa_norte', 'costa_sur'];

    // Definir la relación con las solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_sector');
    }
}
