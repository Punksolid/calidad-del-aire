<?php

namespace App\Http\Controllers;

use App\Registry;
use Illuminate\Http\Request;

class ImecasController extends Controller
{
    public function ozono(Request $request)
    {
        
        $registry = Registry::where('when', $request->when)->first();


        $imeca_o3 = $registry->getImecasFromO3();
        return response([
            'data' => [
                'ozono' => $imeca_o3,
            ],
        ]);
    }

    public function monoxidoDeCarbono(Request $request)
    {
        $registry = Registry::where('when', $request->when)->first();

        $imeca_co = $registry->getImecasFromCO();

        return response([
            'data' => [
                'monoxido_de_carbono' => $imeca_co,
            ],
        ]);
    }

    public function bioxidoDeAzufre(Request $request)
    {
        $registry = Registry::where('when', $request->when)->first();

        $imeca_so2 = $registry->getImecasFromSO2();

        return response([
            'data' => [
                'bioxido_de_azufre' => $imeca_so2,
            ],
        ]);
    }

    public function bioxidoDeNitrogeno(Request $request)
    {
        $registry = Registry::where('when', $request->when)->first();

        $imeca_NO2 = $registry->getImecasFromNO2();

        return response([
            'data' => [
                'bioxido_de_nitrogeno' => $imeca_NO2,
            ],
        ]);
    }
}
