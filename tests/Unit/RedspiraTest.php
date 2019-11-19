<?php

namespace Tests;

use App\AQI;
use App\DeviceRedspira;
use PHPUnit\Framework\TestCase;

class RedspiraTest extends TestCase
{
    public function test_get_last_12_hours_from_a_device()
    {
        $device_id = 'A0034';

        $device = new DeviceRedspira($device_id);

        $last12concentrations = $device->getLast12Hours();

        $last12concentrations->transform(function ($item) {
           return (float)$item;
        });
        $this->assertCount(12,$last12concentrations);
//        $last12concentrations = $last12concentrations->toArray();
//        dd($last12concentrations);
//        $concentration = AQI::nowCast($last12concentrations);

//        $aqi_nowcast = AQI::getAqiOfPM25($concentration);


    }

    public function test_get_nowcast_concentration()
    {
        $device_id = 'A0034';

        $device = new DeviceRedspira($device_id);

        $device->setLast12Hours([
            0 => "11.09",
            1 => "16.23",
            2 => "19.06",
            3 => "34.07",
            4 => "23.74",
            5 => "20.42",
            6 => "19.61",
            7 => "18.83",
            8 => "22.59",
            9 => "22.51",
            10 => "19.59",
            11 => "18.10",
          ]);

        /* @Ref https://www3.epa.gov/airnow/aqicalctest/nowcast.htm */
        $this->assertEquals(15.5, $device->getNowCastConcentration());
    }

    public function test_get_aqi_of_last_12()
    {
        $device_id = 'A0034';

        $device = new DeviceRedspira($device_id);

        $device->setLast12Hours([
            0 => "11.09",
            1 => "16.23",
            2 => "19.06",
            3 => "34.07",
            4 => "23.74",
            5 => "20.42",
            6 => "19.61",
            7 => "18.83",
            8 => "22.59",
            9 => "22.51",
            10 => "19.59",
            11 => "18.10",
        ]);

        $this->assertEquals(58, $device->getNowCastAQI());
    }
}
