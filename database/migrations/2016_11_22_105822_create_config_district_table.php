<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_districs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id');
            $table->integer('district_id');
            $table->string('min_weigh');
            $table->string('max_weigh');
            $table->string('price');
            $table->string('init_weigh');
            $table->string('init_price');
            $table->integer('status');
            $table->string('type');
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
        Schema::drop('config_districs');
    }
}
