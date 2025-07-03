<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;

class clasesController extends Controller
{
    public function index($id)
    {
        $clase = Clase::find($id);
        return $clase;
    }

    public function clase($id)
    {
       $clase = Clase::where('id_alumno', $id)->get();
        return $clase;
    }

    public function list()
    {
        $clase = Clase::all();
        return $clase;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $clase = new Clase();
        } else {
            $clase = Clase::find($request->id);
        }
        $clase->id_sucursal = $request->id_sucursal;
        $clase->id_alumno = $request->id_alumno;
        $clase->id_entrenador = $request->id_entrenador;
        $clase->nivel = $request->nivel;
        $clase->hora_inicio = $request->hora_inicio;
        $clase->hora_fin = $request->hora_fin;
        $clase->fecha = $request->fecha;
        $clase->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $clase = Clase::find($request->id);
        $clase->delete();
        return 'ok';
    }
}
