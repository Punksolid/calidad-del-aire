<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    protected $fillable = [
        'when',
        'O3',
        'NO',
        'NO2',
        'NOx',
        'CO',
        'SO2',
        'PM25',
    ];

    protected $casts = [
        'when' => 'datetime:d/m/y H:i', // 05/12/18 01:00
        'O3' => 'float',
        'NO' => 'float',
        'NO2' => 'float',
        'NOx' => 'float',
        'CO' => 'float',
        'SO2' => 'float',
        'PM25' => 'float',
    ];

    
}
