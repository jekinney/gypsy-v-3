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
        factory(Category::class, 10)->create();
    }
}
