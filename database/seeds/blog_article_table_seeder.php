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

    	foreach ($categories as $category) {
    		$category->articles()->saveMany(factory(Article::class, 30)->create());
    	}
    }
}
