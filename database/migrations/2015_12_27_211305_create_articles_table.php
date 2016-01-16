<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('header_image', 255)->nullable();
            $table->string('slug', 255);
            $table->string('title', 255);
            $table->string('snippet', 500);
            $table->text('body');
            $table->integer('reads')->unsigned()->defualt(0);
            $table->boolean('draft')->default(0);
            $table->timestamp('publish_at');
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
        Schema::drop('blog_articles');
    }
}
