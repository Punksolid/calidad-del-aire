<?php

namespace App\Http\Controllers;

use App\Registry;
use Illuminate\Http\Request;
use App\Imports\RegistryImport;
use Maatwebsite\Excel\Facades\Excel;

class RegistryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $registries = Registry::get();

        
        return response()->json([
            "data" => $registries
        ]);
    }

    public function upload(Request $request) {
        
        Excel::import(new RegistryImport,$request->file('excel'));

        dd(Registry::count());
        dd($request->file('excel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->pm25 = $request->get('PM2.5');
        $data = $this->validate($request, [
            'when' => 'required|date',
            'O3' => 'required',
            'NO' => 'required',
            'NO2' => 'required',
            'NOx' => 'required',
            'CO' => 'required',
            'SO2' => 'required',
            'PM25' => 'required'
        ]);

        $registry = Registry::create($data);
        
        return response()->json([
            "data" => $registry->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registry  $registry
     * @return \Illuminate\Http\Response
     */
    public function show(Registry $registry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registry  $registry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registry $registry)
    {
        //
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
