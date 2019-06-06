<?php

namespace App\Http\Controllers;

use App\Registry;
use Illuminate\Http\Request;
use App\Imports\RegistryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegistryRequest;
use App\Http\Resources\RegistryResource;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RegistryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ]);
        if ($request->filled('start_date')) {
            $start_date = Carbon::make($request->start_date);
        } else {
            $start_date = now()->subDays(3);
        }
        if ($request->filled('end_date')) {
            $end_date = Carbon::make($request->end_date);
        } else {
            $end_date = now();
        }
        // $registries = \DB::table('registries')
        //     ->selectRaw("AVG(NO) NO, DATE_FORMAT(`when`,'%Y-%m-%d %H') hourly, `when`, O3, NO2, NOx, CO, SO2, PM25")
        //     ->groupBy('hourly')
        //     ->where('when', '>', $start_date->toDateTimeString())
        //     ->where('when', '<', $right_now->toDateTimeString())
        //     ->orderBy('when')
        //     ->get();
        $registries = Registry::where('when', '>', $start_date->toDateTimeString())
            ->where('when', '<', $end_date->toDateTimeString())
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

        $data = $request->validate([
            'password' => "required|in:1234567890",
            'file' => [
                'file',
            ],
        ]);
        $file = $data['file'];
        $fileName = $file->getClientOriginalName().'_'.time().'.'.$file->getClientOriginalExtension();

        $file->storeAs('reports', $fileName);
        // foreach($data['file'] as $file) {
        Excel::import(new RegistryImport(), $file);
        // }

        return response([
            'data' => [
                'total' => Registry::count(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RegistryRequest $request)
    {
        $data = $request->toArray();
        $data['when'] = Carbon::createFromFormat('d/m/y H:i', $data['when'])->toDateTimeString();

        $validator = Validator::make($data, [
            'when' => 'unique:registries,when',
        ]);
        if ($validator->fails()) {
            return response(['message' => 'Registro Existente'], 422);
        }

        $registry = Registry::create($data);

        // dump($registry,"aaaaaaaaaaa");
        return  RegistryResource::make($registry->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Registry $registry
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registry $registry)
    {
    }
}
