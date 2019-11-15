<?php

namespace Tests\Feature;

use App\Estacion;
use App\Registry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpClient\HttpClient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Client;

class EstacionesTest extends TestCase
{
    use WithFaker;

//    use RefreshDatabase;

    public function test_registrar_nueva_estacion()
    {
        $form = [
            "_id" => "5cccf5bee2705c1932820580",
            "lat" => 21.873311111111,
            "long" => -102.32080277778,
            "id" => 31,
            "nombre" => "CBTIS",
            "codigo" => "CBT",
            "redesid" => 30,
        ];

        $call = $this->postJson('api/v1/estaciones', $form);

        $call->assertJson(
            [
                'data' => [
                    "unique_id" => $form['_id'],
                    "lat" => $form['lat'],
                    "long" => $form['long'],
                    "id" => $form['id'],
                    "nombre" => $form['nombre'],
                    "codigo" => $form['codigo'],
                    "redesid" => $form['redesid'],
                ],
            ]
        );
    }

    public function test_importar_estacione_del_sinaica()
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'https://api.datos.gob.mx/v2/sinaica-estaciones?pageSize=300');

        foreach ($response->toArray(true)['results'] as $estacion_arr) {
            $estacion = Estacion::Import($estacion_arr);
        }


        dump(Estacion::count());

    }

    public function test_importar_registros()
    {
        // se quedó en la pagina 447
        dump(Registry::count());
        DB::disableQueryLog();
        $httpClient = HttpClient::create();
        $time = now();
        $pageSize = 10000;
        $station_id = 101;
        $page = 447;
        $response = $httpClient->request(
            'GET',
            "https://api.datos.gob.mx/v2/sinaica?page=$page&pageSize=$pageSize"
        )->toArray();
        $total_registries = $response['pagination']['total'];
        $total_of_pages = $total_registries / $pageSize;
        $total_of_pages = round($total_of_pages);
        dump("Total pages: ". $total_of_pages);
        for ($page = 447; $page <= $total_of_pages + 1; $page++) {
            dump('Page: '. $page);
            $tiempo_del_request = now();
            $response = $httpClient
                ->request(
                    'GET',
                    "https://api.datos.gob.mx/v2/sinaica?page=$page&pageSize=$pageSize"
                )
                ->toArray();
            $fin_del_request = now();

            $this->addOrUpdateRegistries($response['results']);
            dump($time->diffForHumans(now()).", Request time: ".$tiempo_del_request->diffForHumans($fin_del_request), ' Update Or Insert time: '. $fin_del_request->diffForHumans(now()));

        }

        dump($time->diffForHumans(now()));
        dd(Registry::count());

    }

    public function test_importar_estaciones()
    {
        $httpClient = HttpClient::create();
        $pageSize = 10000;
        $response = $httpClient->request(
            'GET',
            "https://api.datos.gob.mx/v2/sinaica-estaciones?pageSize=$pageSize"
        )->toArray();
        foreach ($response['results'] as $station) {
            Estacion::updateOrCreate([
                'id' => $station['id']
            ],
                $station
            );
        }
        dd(Estacion::count());
    }

    public function test_estacion_con_mas_datapoints()
    {
        $estaciones =
        DB::table('estaciones')
            ->select([

                'estaciones.*',

//                'name',
            ])
            ->leftJoin('registries','estaciones.id','=','registries.station_id')
            ->groupBy([
                'registries.station_id'
            ])->get();
        dd($estaciones);
    }

    public function test_add_a_registry()
    {

        $httpClient = HttpClient::create();
        $pageSize = 10;
        $station_id = 101;
        $page = 1;
        $response = $httpClient->request(
            'GET',
            "https://api.datos.gob.mx/v2/sinaica?page=$page&pageSize=$pageSize&estacionesid=$station_id"
        )->toArray();
        dump(Registry::count());

        $this->addOrUpdateRegistries($response);

        dump(Registry::count());
    }

    public function resolveField($registry)
    {
        $parametro = $registry['parametro'];
        $value = $registry['valororig'];
        $mapping = [
            "CO" => 'CO',
            "O3" => 'O3',
            "PM10" => 'PM10',
            "SO2" => 'SO2',
            "NO2" => 'NO2',
            "PM2.5" => 'PM25',
            "TMP" => null,
        ];

        return [
            $mapping[$parametro] => $value
        ];
    }
//[
//'when' => $registry['date'],
//'O3',  // ppb
//'NO', // ppb
//'NO2', // ppb
//'NOx', // ppb
//'CO', // ppm
//'SO2', // ppb
//'PM25', // ug/m3
//'date',
//]
    /**
     * @param array $registries
     */
    private function addOrUpdateRegistries(array $registries): void
    {

        foreach ($registries as $registry) {
            $attribute_to_update = $this->resolveField($registry);
            try {
                Registry::updateOrCreate(
                    [
                        'station_id' => $registry['estacionesid'],
//                        'date' => $registry['date'],
                        'when' => $registry['date']
                    ],
                    $attribute_to_update
                );
            }catch (\Exception $exception) {
                dump($exception->getMessage());
                dump($registry);
                dump($attribute_to_update);
                throw $exception;
                Log::error('Error con registro', $registry);
            }

        }
    }

}
