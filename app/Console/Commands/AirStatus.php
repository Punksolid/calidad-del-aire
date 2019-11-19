<?php

namespace App\Console\Commands;

use App\DeviceRedspira;
use App\Subscriber;
use Illuminate\Console\Command;
use Symfony\Component\HttpClient\HttpClient;
use Twilio\Rest\Client;

class AirStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'air:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns the status of the air quality';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = HttpClient::create();

        $device = new DeviceRedspira('A0034');
        $val_aqi = $device->getNowCastAQI();


        $client->request('POST', env('BOT_WEBHOOK'), [
            'body' => [
                'value1' => $this->getMessage($val_aqi),
                'value2' => "Puntos AQI $val_aqi"
            ]
        ]);

        $this->sendWhatsapp(null, $this->getMessage($val_aqi));

        $this->info('normal');
    }

    public function getStatus($aqi)
    {

        //0 to 50 	Good 	Green
        if ($aqi <= 50){
            return 'good';
        }
        if ($aqi <= 101){
            return 'moderate';
        }
        if ($aqi <= 101){ //101 to 150 	Unhealthy for Sensitive Groups 	Orange
            return 'unhealty for sensitive groups';
        }
        if ($aqi <= 200){ //     151 to 200 	Unhealthy 	Red
            return 'unhealty';
        }
        if ($aqi <= 300) {
            return 'very unhealty';
        }
        if ($aqi >= 301) {
            return 'very unhealty';
        }

    }

    public function getMessage($aqi) {
        //0 to 50 	Good 	Green
        if ($aqi <= 50){
            return 'La calidad del aire de Culiacán es buena.';
        }
        if ($aqi <= 101){
            return 'La calidad del aire de Culiacán es moderada.';
        }
        if ($aqi <= 101){ //101 to 150 	Unhealthy for Sensitive Groups 	Orange
            return 'La calidad del aire de Culiacán es insalubre para grupos sensibles.';
        }
        if ($aqi <= 200){ //     151 to 200 	Unhealthy 	Red
            return 'La calidad del aire de Culiacán es insalubre.';
        }
        if ($aqi <= 300) {
            return 'La calidad del aire de Culiacán es muy insalubre';
        }
        if ($aqi >= 301) {
            return 'La calidad del aire de Culiacán es salvese quien pueda.';
        }
    }

    public function sendWhatsapp($to, $message )
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $client = new Client($sid, $token);

        $message = $client->messages
            ->create("whatsapp:+5216672067464", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => $message
                )
            );

        print($message->sid);

    }
}
