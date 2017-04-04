<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrameRaitingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_raitings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('frame_id')->unsigned();
            $table->foreign('frame_id')->references('id')->on('frames')->onDelete('cascade');
            $table->string('name',25);
            $table->string('email',25);
            $table->tinyInteger('mumber');
            $table->string('comment');
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
        Schema::drop('frame_raitings');
    }
}
