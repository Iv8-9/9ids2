<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class membresiaController extends Controller
{
    public function index($id)
    {
        $membresia = Membresia::find($id);

        if ($membresia) {
            try {
                $membresia->rfc = Crypt::decrypt($membresia->rfc);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $membresia->rfc = 'Error al desencriptar';
            }
        }

        return $membresia;
    }

    public function list()
    {
        $membresias = Membresia::select(
            'membresia.*',
            'users.nombre',
            'users.app',
            'users.apm',
            'tipo_membresia.nombre_membresia',
            'tipo_membresia.no_clases'
        )
            ->join('users', 'membresia.id_persona', '=', 'users.id')
            ->join('tipo_membresia', 'membresia.id_tipo_membresia', '=', 'tipo_membresia.id')
            ->get();

        foreach ($membresias as $membresia) {
            try {
                $membresia->rfc = Crypt::decrypt($membresia->rfc);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                $membresia->rfc = 'Error al desencriptar';
            }
        }

        return $membresias;
    }

    public function store(Request $request)
    {
        $request->merge([
            'tipo_pago' => strtolower($request->input('tipo_pago')),
        ]);

        $request->validate([
            'rfc' => 'required|string|max:13',
            'tipo_pago' => 'required|string|in:efectivo,tarjeta,transferencia',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        if ($request->id == 0) {
            $membresia = new Membresia();
        } else {
            $membresia = Membresia::find($request->id);
            if (!$membresia) {
                return response()->json(['error' => 'Membresía no encontrada'], 404);
            }
        }

        $membresia->id_tipo_membresia = $request->id_tipo_membresia;
        $membresia->id_persona = $request->id_persona;
        $membresia->rfc = Crypt::encrypt($request->rfc);
        $membresia->tipo_pago = $request->tipo_pago;
        $membresia->fecha_inicio = $request->fecha_inicio;
        $membresia->fecha_fin = $request->fecha_fin;
        $membresia->estatus = $request->estatus;
        $membresia->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $membresia = Membresia::find($request->id);
        $membresia->delete();
        return 'ok';
    }
}
