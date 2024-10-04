<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prueba;

class pruebaController extends Controller
{
    public function prueba(Request $request){
        $formulario=[
            'nombre'=>$request->query('nombre'),
            'apellido'=>$request->query('apellido'),
            'rut'=>$request->query('rut')
        ];

        Prueba::updateOrCreate([
            'nombre'=>$request->query('nombre'),
            'apellido'=>$request->query('apellido'),
            'rut'=>$request->query('rut')
        ]);

        return response()->json(['Se ha guardao con exito']);
    }

    public function verDatos(Request $request){
        $datos=Prueba::where('rut', $request->query('rut'))->get();
        return response()->json(['mensaje desde la base de datos'=>$datos]);
    }

}
