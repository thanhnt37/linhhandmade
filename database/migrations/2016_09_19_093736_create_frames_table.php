<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('sku');
            $table->string('img');
            $table->text('description');
            $table->text('content');
            $table->integer('price');
            $table->integer('price_sale');
            $table->integer('status');
            $table->string('code_frame');
            $table->integer('label');
            $table->integer('attribute_id');
            $table->string('thumb_images');
            $table->integer('create_by');
            $table->integer('last_edit_by');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::drop('frames');
    }
}
