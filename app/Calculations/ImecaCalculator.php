<?php


namespace App\Calculations;


use Exception;

class ImecaCalculator
{
    const IMECA_FACTOR_LOW = 0.833;
    const IMECA_FACTOR_HIGH = 0.625;

    /**
     * @param string $pollutant
     * @param int $value
     * @return float|int
     * @throws Exception
     */
    public static function calculate(string $pollutant, float $value)
    {
        if ($pollutant == 'pm10') {
            return self::calculatePM10($value);
        }
        if ($pollutant == 'pm25') {
            return self::calculatePM25($value);
        }

        throw new Exception('Pollutant Not Recognized');
    }

    /**
     * @inheritDoc https://rama.edomex.gob.mx/imeca
     */
    public static function calculatePM10($ugr_m3)
    {
        if ($ugr_m3 <= 40) {
            return round(1.25 * $ugr_m3);
        }
        if ($ugr_m3 <= 75) {
            return round(1.44 * ($ugr_m3 - 41) + 51);
        }
        if ($ugr_m3 <= 214) {
            return round(0.355 * ($ugr_m3 - 76) + 101);
        }
        if ($ugr_m3 <= 354) {
            return round(0.353 * ($ugr_m3 - 215) + 151);
        }

    }

//    public static function calculatePM10( $ugr_m3)
//    {
//        if ($ugr_m3 <= 120) {
//            return round($ugr_m3 * (5/6));
//        }
//        if ($ugr_m3 <= 320) {
//            return round(($ugr_m3 * 0.5) + 40);
//        }
//        if ($ugr_m3 > 320) {
//            return round($ugr_m3 * (5/8));
//        }
//
//        throw new \Exception('Bad Input');
//    }

    /**
     * Calculate Imeca Points for PM2.5 particles
     *
     * @param float $u_m3
     * @return float|int Imecas
     */
    public static function calculatePM25(float $u_m3)
    {
        if ($u_m3 <= 15.4) {
            return intval($u_m3 * (50 / 15.4));
        }
        if ($u_m3 <= 40.4) {
            return intval(20.50 + $u_m3 * (49 / 24.9));
        }
        if ($u_m3 <= 65.4) {
            return intval(21.30 + $u_m3 * (49 / 24.9));
        }
        if ($u_m3 <= 150.4) {
            return intval(113.20 + $u_m3 * (49 / 84.9));
        }

        return intval($u_m3 * (201 / 150.5));
    }


}
