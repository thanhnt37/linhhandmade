<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('sku', 25);
            $table->string('img');
            $table->string('short_description');
            $table->string('price', 14);
            $table->string('price_sale', 14);
            $table->text('description');
            $table->text('models');
            $table->text('industries');
            //$table->tinyInteger('Ispromotion');
            $table->string('status', 20)->default('publish');
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
        Schema::drop('products');
    }
}
