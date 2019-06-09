<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditInfoController extends Controller
{
    public function getUploadedResume(Request $request)
    {
        $year = now()->year;
        if($request->filled('year')){
            $year = $request->year;
        }

        $registries = \DB::table('registries')
            ->selectRaw("COUNT(*) as registros, DATE_FORMAT(`when`,'%Y-%m-%d') day")
            ->where('when', '>', "$year-01-01 00:00:01")
            ->where('when', '<', "$year-12-31 23:59:59")
            ->groupBy('day')                
            ->get();

        return response()->json([
            "data" => $registries->toArray()
        ]);
    }
}
