<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductIdToFrameAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frame_attributes', function (Blueprint $table) {
            //
            $table->integer('product_id');
            $table->integer('status_frame');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frame_attributes', function (Blueprint $table) {
            //
              $table->dropColumn(['product_id', 'status_frame']);
        });
    }
}
