<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;

class TrackingController extends Controller
{

    public function get_records()
    {
        return Tracking::all();
    }
    //
    public function store(Request $request)
    {
        //Validar datos 
        $validatedData = $request->validate([

            'device' => 'required|string|max:255',
            'latitud' => 'required',
            'longitud' => 'required',
            'up' =>  'integer',
            'down' => 'integer',
            'signal' => 'string|max:255',
            'power' => 'integer'
        ]);
        $validatedData['up'] = 0;
        $validatedData['down'] = 0;
        $validatedData['signal'] = "0";
        $validatedData['power'] = 0;
        // Crear registro
        Tracking::create([
            'device' => $validatedData['device'],
            'latitud' => $validatedData['latitud'],
            'longitud' => $validatedData['longitud'],
            'up' => $validatedData['up'],
            'down' => $validatedData['down'],
            'signal'=> $validatedData['signal'],
            'power' => $validatedData['power']
        ]);

        return response()->json(['message' => 'Guardado con exito'],200);

    }
}
