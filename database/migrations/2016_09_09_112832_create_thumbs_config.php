<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThumbsConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thumbs_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//product or post
            $table->string('type');// category or review or detail
            $table->integer('width');
            $table->integer('height');
            $table->integer('status');
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
        Schema::drop('thumbs_config');
    }
}
