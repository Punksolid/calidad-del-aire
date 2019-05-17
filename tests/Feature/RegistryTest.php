<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RegistryTest extends TestCase
{
    /**
     * @test
     */
    public function usuario_puede_registrar_valor_de_un_minuto_determinado()
    {
        $data = [
            'when' => '01/12/18 00:00',
            'O3' => 4.7,
            'NO' => 8.8,
            'NO2' => 13.9,
            'NOx' => 22.7,
            'CO' => 4.4,
            'SO2' => 1.8,
            'PM25' => 10.1
        ];

        $call = $this->postJson('api/v1/registries', $data);

        $call->assertJson([
            "data" =>  $data
        ]);
    }

    /**
     * @test
     */
    public function usuario_puede_ver_listado_de_registros()
    {
        $call = $this->getJson('api/v1/registries');
        
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
    public function usuario_puede_importar_archivo_excel()
    {
        $file = Storage::url(storage_path('/app/aire_culiacan.xls'));
        UploadedFile::
        dd($file);
        $call = $this->postJson('api/v1/registries/upload', [
            
        ]);
    }
}
