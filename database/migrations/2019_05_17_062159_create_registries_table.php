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
            $table->unsignedBigInteger('station_id');
            $table->dateTime('when');
            $table->dateTimeTz('date');
            $table->decimal('O3', 8, 6)->nullable();
            $table->decimal('NO', 8, 6)->nullable();
            $table->decimal('NO2', 8, 6)->nullable();
            $table->decimal('NOx', 8, 6)->nullable();
            $table->decimal('CO', 8, 6)->nullable();
            $table->decimal('SO2', 8, 6)->nullable();
            $table->decimal('PM25', 8, 6)->nullable();
            $table->decimal('PM10', 8, 6)->nullable();
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
