<?php

namespace App\Http\Controllers;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mews\Purifier\Facades\Purifier;

class sucursalesController extends Controller
{
    public function index($id)
    {
        $sucursal =Sucursal::find($id);
        return $sucursal;
    }

    public function list()
    {
        $sucursal =Sucursal::all();
        return $sucursal;
    }
    
    public function store(Request $request)
    {
        if($request->id == 0){ 
            $sucursal = new Sucursal();
        }else{
            $sucursal = Sucursal::find($request->id);
        }
        $sucursal->nombre_sucursal =  $request->nombre_sucursal;
        $sucursal->direccion =  $request->direccion;
        $sucursal->telefono =  $request->telefono;
        $sucursal->email =  $request->email;
        $sucursal->horario =  $request->horario;
        $sucursal->tipo_piscina =  $request->tipo_piscina;
        $sucursal->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $sucursal = Sucursal::find($request->id);
        $sucursal->delete();
        return 'ok';
    }
}
