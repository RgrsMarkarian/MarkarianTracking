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


        //Convertir Longitud
        $lng =  $validatedData['longitud'];
        $brk = strpos($lng,".") - 2;
        if($brk < 0){ $brk = 0; }

        $minutes = substr($lng, $brk);
        $degrees = substr($lng, 0,$brk);

        $newLng = $degrees + $minutes/60;

        if(stristr($lng,"W")){
            $newLng = -1 * $newLng;
        }

        //Convertir Latitud
        $lat =  $validatedData['latitud'];
        $brk2 = strpos($lat,".") - 2;
        if($brk2 < 0){ $brk2 = 0; }

        $minutes2 = substr($lat, $brk2);
        $degrees2 = substr($lat, 0,$brk2);

        $newLat = $degrees2 + $minutes2/60;

        if(stristr($lng,"W")){
            $newLat = -1 * $newLat;
        }




        // Crear registro
        Tracking::create([
            'device' => $validatedData['device'],
            'latitud' => $newLat,
            'longitud' => $newLon,
            'up' => $validatedData['up'],
            'down' => $validatedData['down'],
            'signal'=> $validatedData['signal'],
            'power' => $validatedData['power']
        ]);

        return response()->json(['message' => 'Guardado con exito'],200);

    }
}
