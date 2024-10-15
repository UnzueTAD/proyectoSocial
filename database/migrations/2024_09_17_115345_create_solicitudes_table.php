<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('rut');
            $table->string('digito_verificador');
            $table->string('motivo_solicitud');
            $table->date('fecha_solicitud');
            $table->string('sector');
            $table->string('estado_solicitud');
            $table->string('contacto');
            $table->string('localidad');
            $table->timestamps();  // Para las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
}
