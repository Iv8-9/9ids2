<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mews\Purifier\Facades\Purifier;

class asistenciaController extends Controller
{
    public function index($id)
    {
        $asistencia =Asistencia::find($id);
        return $asistencia;
    }

    public function list()
    {
        $asistencia =Asistencia::all();
        return $asistencia;
    }
    
    public function store(Request $request)
    {
        if($request->id == 0){ 
            $asistencia = new Asistencia();
        }else{
            $asistencia = Asistencia::find($request->id);
        }
        $asistencia->id_clase =  $request->id_clase;
        $asistencia->confirmacion =  $request->confirmacion;
        $asistencia->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $asistencia = Asistencia::find($request->id);
        $asistencia->delete();
        return 'ok';
    }
}
