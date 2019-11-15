<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirBotTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_command_to_check_air_quality_last_hour()
    {
         $this->artisan('air:status')
            ->expectsOutput('normal');

    }
}
