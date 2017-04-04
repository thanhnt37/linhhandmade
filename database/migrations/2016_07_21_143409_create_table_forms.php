<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text_1');
            $table->string('text_2');
            $table->string('text_3');
            $table->string('text_4');
            $table->string('text_5');
            $table->string('text_6');
            $table->string('text_7');
            $table->string('text_8');
            $table->string('text_9');
            $table->string('text_10');
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
        Schema::drop('form');
    }
}
