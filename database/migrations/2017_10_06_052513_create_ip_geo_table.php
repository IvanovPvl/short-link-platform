<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpGeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_geo', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('ip');
            $table->string('country');
            $table->string('country_code');
            $table->string('region');
            $table->string('region_name');
            $table->string('city');

            $table->index('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ip_geo');
    }
}
