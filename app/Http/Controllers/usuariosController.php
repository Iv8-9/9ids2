<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usuariosController extends Controller
{
    public function index($id)
    {
        $persona =Persona::find($id);
        return $persona;
    }

    public function roles(Request $request)
    {
        $persona = Persona::where('rol', $request->rol)->get();
        return $persona;
    }

    public function list()
    {
        $persona =Persona::all();
        return $persona;
    }
    
    public function store(Request $request)
    {
        if($request->id == 0){ 
            $persona = new Persona();
        }else{
            $persona = Persona::find($request->id);
        }
        $persona->name =  $request->name;
        $persona->email =  $request->email;
        $persona->password = Hash::make($request->password);

        $persona->nombre =  $request->nombre;
        $persona->app =  $request->app;
        $persona->apm =  $request->apm;
        $persona->edad =  $request->edad;
        $persona->direccion =  $request->direccion;
        $persona->rol =$request->rol;
        $persona->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $persona = Persona::find($request->id);
        $persona->delete();
        return 'ok';
    }
}