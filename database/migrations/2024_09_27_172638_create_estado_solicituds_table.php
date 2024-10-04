<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoSolicitudsTable extends Migration
{
    public function up()
    {
        Schema::create('estado_solicituds', function (Blueprint $table) {
            $table->id('id_estsol'); // Clave primaria
            $table->string('ingresado')->nullable();
            $table->string('pendiente')->nullable();
            $table->string('rechazado')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_solicituds');
    }
}

