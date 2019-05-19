<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Monolog\Registry;
use Carbon\Carbon;

class RegistryTest extends TestCase
{
    use WithFaker;
    /**
     * @test
     */
    public function usuario_puede_registrar_valor_de_un_minuto_determinado()
    {
        $data = [
            // 'when' => '06/12/18 02:26',
            'when' => Carbon::now()->addMinutes(rand(1, 10))->format('d/m/y H:i'),
            'O3' => 4.7,
            'NO' => 8.8,
            'NO2' => 13.9,
            'NOx' => 22.7,
            'CO' => 4.4,
            'SO2' => 1.8,
            'PM25' => 10.1
        ];
        // dd($data);
        $call = $this->postJson('api/v1/registries', $data);
        $call->assertJson([
            "data" =>  $data
        ]);
    }

    /**
     * @test
     */
    public function usuario_no_puede_registrar_valor_de_un_minuto_ya_registrado()
    {
        $data = [
            'when' => '02/12/19 00:02',
            'O3' => 4.7,
            'NO' => 8.8,
            'NO2' => 13.9,
            'NOx' => 22.7,
            'CO' => 4.4,
            'SO2' => 1.8,
            'PM25' => 10.1
        ];
        $call = $this->postJson('api/v1/registries', $data);
        $call->assertStatus(422);
    }

    /**
     * @test
     */
    public function usuario_puede_ver_listado_de_registros()
    {
        $call = $this->getJson('api/v1/registries');
        $call->dump();
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    'when',
                    'O3',
                    'NO',
                    'NO2',
                    'NOx',
                    'CO',
                    'SO2',
                    'PM25'
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function usuario_puede_ver_registro_agrupados_por_hora()
    {
        // $registries = \DB::table('registries')
        $registries = \DB::table('registries')
        ->selectRaw("AVG(NO) averageO3, DATE_FORMAT(`when`,'%Y-%m-%d %H') hourly")
        // ->select(\DB::raw('*, HOUR(when) as hour'))
        ->selectRaw("AVG(NO) averageO3, DATE_FORMAT(`when`,'%Y-%m-%d %H') hourly")
        ->groupBy("hourly")
        // ->groupBy(\DB::raw("DATE_FORMAT(`when`, '%Y-%m-%d %H')"))
                    // ->take(10)
                    ->get();

        dd($registries);
        $this->assertEquals(48, $registries->count());
    }
}
