<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentFrameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_frames', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_guest')->default(1);
            $table->integer('account_id');
            $table->integer('frame_id');
            $table->string('comment');
            $table->decimal('rating', 3, 2);
            $table->string('comment_admin');
            $table->integer('parent_id')->default(0);
            $table->integer('status')->default(0);
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
        Schema::drop('comment_frames');
    }
}
