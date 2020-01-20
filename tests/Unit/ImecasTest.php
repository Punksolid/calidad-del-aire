<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Registry;

class ImecasTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_see_imeca_points_from_ozono()
    {
        $this->withoutExceptionHandling();
        $registry = Registry::first();
        $call = $this->getJson("api/v1/imecas/ozono?when={$registry->when}");

        $call->assertJsonStructure([
            'data' => [
                'ozono',
            ],
        ]);

        $call->assertJsonFragment([
            'ozono' => 4,
        ]);
        $call->assertSuccessful();
    }

    /**
     *  @test
     */
    public function user_can_see_imeca_points_from_monoxido_de_carbono()
    {
        $this->withoutExceptionHandling();

        $registry = Registry::first();

        $call = $this->getJson("api/v1/imecas/monoxido_de_carbono?when={$registry->when}");

        $call->assertJsonStructure([
            'data' => [
                'monoxido_de_carbono',
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_can_see_imeca_points_from_bioxido_de_azufre()
    {
        $this->withoutExceptionHandling();

        $registry = Registry::first();

        $call = $this->getJson("api/v1/imecas/bioxido_de_azufre?when={$registry->when}");

        $call->assertJsonStructure([
            'data' => [
                'bioxido_de_azufre',
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_can_see_imeca_points_from_bioxido_de_nitrogeno()
    {
        $registry = Registry::first();

        $call = $this->getJson("api/v1/imecas/bioxido_de_nitrogeno?when={$registry->when}");

        $call->assertJsonStructure([
            'data' => [
                'bioxido_de_nitrogeno',
            ],
        ]);
    }
}
