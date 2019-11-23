<?php

namespace Tests\Unit;

use App\Calculations\ImecaCalculator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImecasTest extends TestCase
{

    public function test_calcular_imeca_pm10()
    {
        /**
         *  PARTÍCULAS SUSPENDIDAS FRACCIÓN RESPIRABLE (PM10)
         * DE 0 A 120 µ/m3
         * IMECA PM10 = CONCENTRACIÓN DE PM10 * 0.833
         * DE 121 A 320 µ/m3
         * IMECA PM10 = (CONCENTRACIÓN DE PM10 * 0.5) + 40
         * MAYOR A 320 µ/m3
         * IMECA PM10 = CONCENTRACIÓN DE PM10 * 0.625
         * 49	µg/m³
         */
        $imecas_pm10 = ImecaCalculator::calculate('pm10', 75 );
        $this->assertEquals(100, $imecas_pm10); // Funciona ejemplo twitter Medio Ambiente

        $imecas_pm10 = ImecaCalculator::calculate('pm10', 30 );
        $this->assertEquals(38, $imecas_pm10); // No funciona
//
        $imecas_pm10 = ImecaCalculator::calculate('pm10', 80 );
        $this->assertEquals(102, $imecas_pm10); // Funciona
        //

        $imecas_pm10 = ImecaCalculator::calculate('pm10', 300 );
        $this->assertEquals(181, $imecas_pm10); // Funciona
    }

    public function test_calculate_imeca_pm25()
    {
        $imecas_pm25 = ImecaCalculator::calculate('pm25', 28);

        $this->assertEquals(75, $imecas_pm25, 'Imecas for pm25 are right');
    }


}
