<?php

namespace Tests\Unit;

use App\AQI;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AQITest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_concentrations_with_nowcast_method()
    {
// aqi 90 con nowcast
        $last_hours = [ 16.34,4.23,132.72, null, 6.67, 136.59, null, 9.85, 18.46, 50.55, 62.18, 60.31 ];
//        $last_hours = [ 13, 16, 10, 21, 74, 64, 53, 82, 90, 75, 80, 50 ];

        $nowcast_concentration = AQI::nowCast($last_hours);

        $this->assertEquals(30.4, $nowcast_concentration);
//        $this->assertEquals(89, $aqi);
    }

    public function test_get_level()
    {
        $concentration_pm25 = 56;

        $level = AQI::getLevel(56);

        $this->assertEquals(4, $level);
    }

    public function test_convert_concentration_to_aqi()
    {
        $aqi = AQI::getAqi(30, 'pm25');
        $aqi = intval($aqi);

        $this->assertEquals(88, $aqi);
    }


}
