<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColAndDropGroupAttribute extends Migration
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
            $table->dropForeign('group_attributes_attribute_id_foreign');
            $table->dropColumn('attribute_id');
            $table->integer('number_product');
            $table->integer('filter_id');
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
