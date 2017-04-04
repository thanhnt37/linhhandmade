<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img_1');
            $table->string('img_2');
            $table->string('img_3');
            $table->string('text_1');
            $table->string('text_2');
            $table->string('text_3');
            $table->string('text_4');
            $table->text('des_1');
            $table->text('des_2');
            $table->string('link_1');
            $table->string('link_2');
            $table->string('type');
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
        Schema::drop('=slides');
    }
}
