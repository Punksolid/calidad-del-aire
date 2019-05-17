<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('when'); 
            $table->decimal('O3'); 
            $table->decimal('NO'); 
            $table->decimal('NO2'); 
            $table->decimal('NOx'); 
            $table->decimal('CO'); 
            $table->decimal('SO2'); 
            $table->decimal('PM25'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registries');
    }
}
