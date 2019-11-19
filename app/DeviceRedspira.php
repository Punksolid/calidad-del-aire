<?php


namespace App;


use Carbon\Carbon;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeviceRedspira
{
    private $device_id;
    /**
     * @var HttpClientInterface
     */
    private $client;
    private $last12hours;

    public function __construct($device_id)
    {
        $this->device_id = $device_id;
        $this->client = HttpClient::create();
        $this->last12hours = collect();
    }

    public function getLast12Hours()
    {
        $right_now = Carbon::now("-7")->addHour()->toDateTimeString();
        $right_now = urlencode($right_now);
        $since = Carbon::now("-7")->subHours(13)->toDateTimeString();
        $since = urlencode($since);
        $url = "http://app.respira.org.mx/ws/get-monitor-data.php?idmonitor={$this->device_id}&idparam=PM25&interval=hour&datetime1=$since&datetime2=$right_now&timeoffset=-7";
        $response = $this
            ->client
            ->request(
                'GET',
//                "http://app.respira.org.mx/ws/get-monitor-data.php?idmonitor={$this->device_id}&idparam=PM25&interval=hour&datetime1=2000-01-01%2000%3A00%3A00&datetime2=5000-01-01%2023%3A00%3A00&timeoffset=-7"
                $url
            );
        $last12concentrations = json_decode($response->getContent());

        $last12concentrations = collect($last12concentrations);

        return $this->last12hours = $last12concentrations->pluck('val_prom');

    }

    /**
     * @param array $array
     */
    public function setLast12Hours(array $array)
    {
        $this->last12hours = collect($array);
    }

    /**
     * @todo BUG is doing a round up when it should truncate to keep just one decimal
     * @return string
     */
    public function getNowCastConcentration()
    {
        $last12hours = $this->last12hours->toArray() ?: $this->getLast12Hours()->toArray();

        return number_format(AQI::nowCast($last12hours),1);
    }

    public function getNowCastAQI($pollutant = 'pm25')
    {
        $concentration = $this->getNowCastConcentration();

        return intval(AQI::getAqiOfPM25($concentration));
    }


}
