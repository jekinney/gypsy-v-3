<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_item_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->default(0);
            $table->string('thumbnail');
            $table->string('large');
            $table->integer('order');
            $table->boolean('main')->default(0);
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
        Schema::drop('market_item_images');
    }
}
