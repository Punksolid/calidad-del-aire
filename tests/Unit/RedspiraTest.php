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

        $last12concentrations = $device->getLast12Hours('PM25');
        $this->assertCount(12,$last12concentrations);
//        $last12concentrations = $last12concentrations->toArray();
//        dd($last12concentrations);
//        $concentration = AQI::nowCast($last12concentrations);

//        $aqi_nowcast = AQI::getAqiOfPM25($concentration);

    }

    public function test_get_nowcast_concentration_of_pm_25()
    {
        $device_id = 'A0034';

        $device = new DeviceRedspira($device_id);

        $device->setLast12Hours('pm25',[
            0 => 11.09,
            1 => 16.23,
            2 => 19.06,
            3 => 34.07,
            4 => 23.74,
            5 => 20.42,
            6 => 19.61,
            7 => 18.83,
            8 => 22.59,
            9 => 22.51,
            10 => 19.59,
            11 => 18.10,
          ]);

        /* @Ref https://www3.epa.gov/airnow/aqicalctest/nowcast.htm */
        $this->assertEquals(15.5, $device->getNowCastConcentration());
    }
    public function test_getLast12Hours()
    {
        $device = new DeviceRedspira('A0034');

        $this->assertCount(12,$device->getLast12Hours('pm10'));
    }
    public function test_get_aqi_of_last_12()
    {
        $device_id = 'A0034';

        $device = new DeviceRedspira($device_id);

        $device->setLast12Hours('pm25',[
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

        $this->assertEquals(58, $device->getNowCastAQI('pm25'));
    }

    public function test_get_aqi_of_last_12_hours_from_remote_request()
    {

        $device = new DeviceRedspira('A0034');

        $this->assertIsNumeric( $device->getNowCastAQI('pm25'));
    }

    public function test_get_imeca_of_last12_pm10()
    {
        $device = new DeviceRedspira('A0034');
        $device->setLast12Hours('pm10', [
            0 => 75,
            1 => 75,
            2 => 75,
            3 => 75,
            4 => 75,
            5 => 75,
            6 => 75,
            7 => 75,
            8 => 75,
            9 => 75,
            10 => 75,
            11 => 75,
        ]);
        $device->setLast12Hours('pm25', [
            0 => 75,
            1 => 75,
            2 => 75,
            3 => 75,
            4 => 75,
            5 => 75,
            6 => 75,
            7 => 75,
            8 => 75,
            9 => 75,
            10 => 75,
            11 => 75,
        ]);

        $this->assertEquals(156, $device->getLast12HoursIMECAS()); // Funciona ejemplo twitter Medio Ambiente

    }

    public function test_getLast12HoursIMECAS()
    {
        $device = new DeviceRedspira('A0034');

        $this->assertIsNumeric( $device->getLast12HoursIMECAS());

    }
}
