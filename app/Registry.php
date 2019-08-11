<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    protected $fillable = [
        'when',
        'O3', // ppb
        'NO', // ppb
        'NO2', // ppb
        'NOx', // ppb
        'CO', // ppm
        'SO2', // ppb
        'PM25', // ug/m3
        'PM10', // ug/m3
        'date',
        'station_id'
    ];

    protected $casts = [
        'when' => 'datetime:d/m/y H:i', // 05/12/18 01:00
//        'O3' => 'decimal',
//        'NO' => 'decimal',
//        'NO2' => 'decimal',
//        'NOx' => 'decimal',
////        'CO' => 'decimal',
//        'SO2' => 'decimal',
//        'PM25' => 'decimal',
        'station_id' => 'integer'
    ];

    public function convertToPpm($particle)
    {
        return $this->{$particle}/1000;
    }

    public function getImecasFromO3()
    {
        $ozone_ppm = $this->convertToPpm('O3');

        $imeca_o3 = $ozone_ppm * 100 / 0.11;
        return round($imeca_o3);

    }

    public function getImecasFromCO()
    {
        $monoxido_de_carbono = $this->CO;

        $imeca_co = ($monoxido_de_carbono * 100) / 11;
        return round($imeca_co);
    }

    public function getImecasFromSO2()
    {
        $bioxido_de_azufre = $this->convertToPpm('SO2');

        $imeca_SO2 = ($bioxido_de_azufre * 100) / 0.13;
        return round($imeca_SO2);
    }

    public function getImecasFromNO2()
    {
        $bioxido_de_nitrogeno = $this->convertToPpm('NO2');

        $imeca_NO2 = ($bioxido_de_nitrogeno * 100) / 0.21;
        return round($imeca_NO2);
    }
}
