<?php

namespace App\Http\Controllers;

use App\Registry;
use Illuminate\Http\Request;
use App\Imports\RegistryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegistryRequest;
use App\Http\Resources\RegistryResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RegistryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $registries = Registry::get();
        $registries = \DB::table('registries')
            ->selectRaw("AVG(NO) NO, DATE_FORMAT(`when`,'%Y-%m-%d %H') hourly, `when`, O3, NO2, NOx, CO, SO2, PM25")
            ->groupBy("hourly")
            ->get();
        // dd($registries);
        return RegistryResource::collection($registries);
        // return response()->json([
        //     "data" => $registries
        // ]);
    }

    public function upload(Request $request)
    {
        
        // dd($request->all());
        
        $data = $this->validate($request, [
            'file' => [
                "file"
            ]
        ]);
        $file = $data['file'];
        $fileName = $file->getClientOriginalName()."_".time().'.'.$file->getClientOriginalExtension();

        $file->storeAs('reports', $fileName);
        // foreach($data['file'] as $file) {
        Excel::import(new RegistryImport, $file);
        // }

        return response([
            "data" => [
                "total" => Registry::count()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistryRequest $request)
    {
        $data = $request->toArray();
        $data['when'] = Carbon::createFromFormat("d/m/y H:i", $data['when'])->toDateTimeString();

        $validator = Validator::make($data, [
            'when' => 'unique:registries,when'
        ]);
        if($validator->fails()){
            return response(['message' => 'Registro Existente'], 422);
        }

        $registry = Registry::create($data);
        
        // dump($registry,"aaaaaaaaaaa");
        return  RegistryResource::make($registry->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registry  $registry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registry $registry)
    {
        //
    }
}
