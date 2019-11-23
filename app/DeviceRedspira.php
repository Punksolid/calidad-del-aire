<?php


namespace App;


use App\Calculations\ImecaCalculator;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeviceRedspira
{
    private $device_id;
    /**
     * @var HttpClientInterface
     */
    private $client;
    private  $last12hours;
    private $service_url = "http://app.respira.org.mx/ws/get-monitor-data.php";

    public function __construct($device_id)
    {
        $this->device_id = $device_id;
        $this->client = HttpClient::create();
        $this->last12hours = collect();
    }

    public function getLast12Hours($pollutant): array
    {
        $pollutant = strtoupper($pollutant);
        $right_now = Carbon::now("-7")->addHour()->toDateTimeString();
        $right_now = urlencode($right_now);
        $since = Carbon::now("-7")->subHours(13)->toDateTimeString();
        $since = urlencode($since);
        $url = "{$this->service_url}?idmonitor={$this->device_id}&idparam={$pollutant}&interval=hour&datetime1=$since&datetime2=$right_now&timeoffset=-7";

        $response = $this
            ->client
            ->request(
                'GET',
//                "http://app.respira.org.mx/ws/get-monitor-data.php?idmonitor={$this->device_id}&idparam=PM25&interval=hour&datetime1=2000-01-01%2000%3A00%3A00&datetime2=5000-01-01%2023%3A00%3A00&timeoffset=-7"
                $url
            );
        $last12concentrations = json_decode($response->getContent());
        $this->last12hours->put($pollutant,  array_column($last12concentrations,'val_prom'));


        return $this->last12hours->get($pollutant);

    }

    /**
     * @param string $pollutant
     * @param array $concentrations
     * @return Collection
     */
    public function setLast12Hours(string $pollutant, array $concentrations): Collection
    {
        return $this->last12hours->put($pollutant, $concentrations);
    }

    /**
     * @param string $pollutant
     * @return string
     * @todo BUG is doing a round up when it should truncate to keep just one decimal
     */
    public function getNowCastConcentration($pollutant = 'pm25')
    {
        $last12hours = $this->last12hours->get($pollutant) ?: $this->getLast12Hours($pollutant);
//        dd($this->last12hours->get($pollutant) );
        return number_format(AQI::nowCast($last12hours),1);
    }

    public function getNowCastAQI($pollutant)
    {
        $concentration = $this->getNowCastConcentration($pollutant);

        return intval(AQI::getAqiOfPM25($concentration));
    }

    /**
     * Gives the higher IMECA point
     *
     * @return float|int
     * @throws \Exception
     */
    public function getLast12HoursIMECAS()
    {


        $average_pm10 = $this->getLast12HoursAverage('pm10');
        $average_pm25 = $this->getLast12HoursAverage('pm25');
        $imeca_average_pm10 = $this->getImecasFromConcentration('pm10', $average_pm10);
        $imeca_average_pm25 = $this->getImecasFromConcentration('pm25', $average_pm25);

        if ($imeca_average_pm10 >= $imeca_average_pm25) {
            return $imeca_average_pm10;
        }

        return $imeca_average_pm25;


//        return ImecaCalculator::calculate('pm10', $average);
    }

    public function getImecasFromConcentration(string $pollutant, $concentration)
    {
        return ImecaCalculator::calculate($pollutant, $concentration);
    }

    private function getLast12HoursAverage(string $pollutant): float
    {
//        dd($this->last12hours);
        $concentration_matrix = $this->last12hours->get($pollutant) ?: $this->getLast12Hours($pollutant);
        return array_sum($concentration_matrix)/count($concentration_matrix);
//        return array_sum($this->last12hours->get($pollutant))/count($this->last12hours->get($pollutant));
    }


}
