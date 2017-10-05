<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_agent');
            $table->ipAddress('ip');
            $table->string('os')->default("Unknown");
            $table->string('country_code')->nullable();
            $table->integer('link_id')->unsigned();
            $table->timestamp('created_at');

            $table->index('os');

            $table->foreign('link_id')
                ->references('id')->on('links')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->dropForeign('stats_link_id_foreign');
        });

        Schema::dropIfExists('stats');
    }
}
