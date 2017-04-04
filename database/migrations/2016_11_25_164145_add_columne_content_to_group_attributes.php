<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumneContentToGroupAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_attributes', function (Blueprint $table) {
            //
            $table->string('description');
            $table->text('youtube_links');
            $table->text('contents');
            $table->text('image_links');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_attributes', function (Blueprint $table) {
            //
        });
    }
}
