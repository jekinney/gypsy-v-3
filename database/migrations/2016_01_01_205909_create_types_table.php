<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 120);
            $table->string('title', 120);
            $table->string('slug', 120);
            $table->mediumText('description');
            $table->string('location', 360);
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
        Schema::drop('market_types');
    }
}
