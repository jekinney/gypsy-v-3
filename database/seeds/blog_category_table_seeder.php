<?php

use App\Blog\Category;
use Illuminate\Database\Seeder;

class blog_category_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*
    	Category::create([
        	'title' => 
        	'description' => ''
        ]);
        */
        Category::create([
        	'title' => 'How To',
        	'description' => 'How To Articles',
        ]);

        Category::create([
        	'title' => 'Adventures',
        	'description' => 'My Adventures',
        ]);

        Category::create([
        	'title' => 'Opinion',
        	'description' => 'My and only my opinions',
        ]);
    }
}
