<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('frame_id')->unsigned();
            $table->foreign('frame_id')->references('id')->on('frames')->onDelete('cascade');
            $table->integer('frame_related')->unsigned();
            $table->foreign('frame_related')->references('id')->on('frames')->onDelete('cascade');
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
        Schema::drop('related_products');
    }
}
