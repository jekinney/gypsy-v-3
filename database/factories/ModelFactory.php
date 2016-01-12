<?php
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Blog\Category::class, function (Faker\Generator $faker) {
	$title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => $title,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Blog\Article::class, function (Faker\Generator $faker) {
	$title = $faker->sentence;
    return [
    	'user_id' => factory(App\User::class)->create()->id,
    	'category_id' => factory(App\Blog\Category::class)->create()->id,
    	'header_image' => $faker->imageUrl(1200, 300),
        'title' => $title,
        'slug' => $title,
        'snippet' => $faker->sentence,
        'body' => $faker->paragraph,
        'publish_at' => $faker->dateTimeThisMonth(),
    ];
});