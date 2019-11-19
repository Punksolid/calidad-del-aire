<?php


namespace App;


class AQI
{

    /**
     * @param array $points recent in index 0 and then to index 12
     * @return float|int
     */
    public static function nowCast(array $points)
    {
        $points_without_nulls = array_filter($points);
//        $points_without_nulls = array_filter($points, function ($value){
//            return $value != -1;
//        });
//        dd($points_without_nulls);
        $maximum_value = max($points);
        $minimum_value = min($points_without_nulls);

        $range = $maximum_value - $minimum_value;

        $scaled_rate = $range / $maximum_value;
        $weight_factor = 1 - $scaled_rate;


        if ($weight_factor < 0.5) {
            $weight_factor = 0.5;
        }

        $product_sum = 0;
        $sum_of_weight_factors = 0;
        $exponential = 0;

        foreach ($points_without_nulls as $point) {

            $product_sum += $point*pow($weight_factor,$exponential);
            $sum_of_weight_factors += pow($weight_factor,$exponential);

            $exponential++;
        }

        return $product_sum/$sum_of_weight_factors;

    }

    public static function getLevel(int $concentration, $pullutant = 'pm25')
    {
        if ($concentration <= 12 ) {
            return 1;
        }
        if ($concentration <= 35.5 ) {
            return 2;
        }
        if ($concentration <= 55.5 ) {
            return 3;
        }
        if ($concentration <= 150.5 ) {
            return 4;
        }
        if ($concentration <= 250.5 ) {
            return 5;
        }
        if ($concentration <= 350.5 ) {
            return 6;
        }
        if ($concentration <= 500.5 ) {
            return 7;
        }

        throw new \Exception('Beyond AQI scope');
    }

    public static function getMessage($level) {
        if ($level == 1){
            return 'La calidad del aire de Culiacán es buena.';
        }
        if ($level == 2){
            return 'La calidad del aire de Culiacán es moderada.';
        }
        if ($level == 3){ //101 to 150 	Unhealthy for Sensitive Groups 	Orange
            return 'La calidad del aire de Culiacán es insalubre para grupos sensibles.';
        }
        if ($level == 4){ //     151 to 200 	Unhealthy 	Red
            return 'La calidad del aire de Culiacán es insalubre.';
        }
        if ($level == 5) {
            return 'La calidad del aire de Culiacán es muy insalubre';
        }
        if ($level == 6) {
            return 'La calidad del aire de Culiacán es salvese quien pueda.';
        }
    }

    public static function getAqi(float $concentration, string $pollutant)
    {
        if ($pollutant == 'pm25') {
          return self::getAqiOfPM25($concentration);
        }

        throw new \Exception('Pollutant unknown');
    }

    public static function getAqiOfPM25(float $concentration) {
        $C1 = 0.0;
        $C2 = 0.0;
        $I1 = 0.0;
        $I2 = 0.0;

        if( $concentration <= 12.0) //0-50
        {
            $C1 = 0.0;
            $C2 = 12.0;
            $I1 = 0;
            $I2 = 50;
        } else if($concentration >12.0 && $concentration <=35.4) //51-100
        {
            $C1 = 12.1;
            $C2 = 35.4;
            $I1 = 51;
            $I2 = 100;
        } else if($concentration >35.4 && $concentration <=55.4) //101-150
        {
            $C1 = 35.5;
            $C2 = 55.4;
            $I1 = 101;
            $I2 = 150;
        }
        else
            if($concentration > 55.4 && $concentration <=150.4) //151-200
            {
                $C1 = 55.5;
                $C2 = 150.4;
                $I1 = 151;
                $I2 = 200;
            } else if($concentration > 150.4 && $concentration <=250.4) //201-300
            {
                $C1 = 150.5;
                $C2 = 250.4;
                $I1 = 201;
                $I2 = 300;
            } else if($concentration > 250.4 && $concentration <=350.4) //301-400
            {
                $C1 = 250.5;
                $C2 = 350.4;
                $I1 = 301;
                $I2 = 400;
            }
            else
                if($concentration > 350.4) //401-500
                {
                    $C1 = 350.5;
                    $C2 = 500.4;
                    $I1 = 401;
                    $I2 = 500;
                }


        return ($I2-$I1)/($C2-$C1)*($concentration - $C1) + $I1;
    }
}
