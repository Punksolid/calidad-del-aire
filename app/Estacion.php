<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Estacion extends Model
{
    public $guarded = [];

    public $table = 'estaciones';

    public $casts = [
        'bulk' => 'array'
    ];

    /**
     * @param Request $request
     * @return mixed
     */
    public static function Import( $attributes)
    {
        $estacion = Estacion::make($attributes);
        $estacion->unique_id = $attributes['_id'];
        $estacion->bulk = $attributes;
        $estacion->save();

        return $estacion;
    }
}
