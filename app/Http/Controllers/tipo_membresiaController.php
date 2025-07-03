<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Models\Tipo_membresia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mews\Purifier\Facades\Purifier;

class tipo_membresiaController extends Controller
{
    public function index($id){
        $tipo_membresia = Tipo_membresia::find($id);
        return $tipo_membresia;
    }

    public function list(){
        $membresias = Tipo_membresia::all();
        return $membresias;
    }
    
    public function store(Request $request){
        if ($request->id == 0) {
            $tipo_membresia = new Tipo_membresia();
        } else {
            $tipo_membresia = Tipo_membresia::find($request->id);
            if (!$tipo_membresia) {
                return response()->json(['error' => 'Membresía no encontrada'], 404);
            }
        }

        $tipo_membresia->nombre_membresia = $request->nombre_membresia;
        $tipo_membresia->precio = $request->precio;
        $tipo_membresia->duracion = $request->duracion;
        $tipo_membresia->no_clases = $request->no_clases;

        $tipo_membresia->save();
        return 'ok';
    }

    public function destroy(Request $request){
        $tipo_membresia = Tipo_membresia::find($request->id);
        $tipo_membresia->delete();
        return 'ok';
    }
}
