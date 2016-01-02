<?php

use Carbon\Carbon;
use App\Blog\Article;
use App\Blog\Category;
use Illuminate\Database\Seeder;

class blog_article_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = Category::all();

        $faker = Faker\Factory::create();

    	foreach ($categories as $category) {
    		for($count = 0; $count < 11; $count++) {
    			$title = $faker->sentence();
    			Article::create([
                    'category_id' => $category->id,
    				'user_id'     => 1,
                    'header_image'=> $faker->imageUrl(1200, 400),
    				'slug'        => str_slug($title),
    				'title'       => $title,
    				'snippet'     => $faker->paragraph(),
    				'body'        => $faker->text(5000),
    				'publish_at'  => Carbon::now(),
				]);
    		}
    	}
    }
}
