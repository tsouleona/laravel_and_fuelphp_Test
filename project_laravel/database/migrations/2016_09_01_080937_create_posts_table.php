<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function($table){
            $table->increments('id');
            $table->string('title');
            $table->string('content');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('posts');
    }
}
