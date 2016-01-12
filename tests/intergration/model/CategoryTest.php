<?php

use App\Blog\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
	//use DatabaseTransactions;

	 /**
     * @test
     *
     * @return void
     */
    public function create_or_update_sets_proper_slug()
    {
        $category = factory(Category::class)->create();

        $this->assertEquals($category->slug, str_slug($category->title));

        $category->title = 'Test Update';
        $category->slug  = 'Test Update';
        $category->save();

        $this->assertEquals($category->slug, str_slug($category->title));
    }

    /**
     * @test
     *
     * @return void
     */
    public function list_of_categories_for_select_list()
    {
    	$category = factory(Category::class, 3)->create();

        $categories = Category::selectList();

        $this->assertEquals(3, $categories->count());
    }

    /**
     * @test
     *
     * @return void
     */
    public function list_of_categories_to_display()
    {
    	$category = factory(Category::class, 3)->create();

        $categories = Category::Listing();

        $this->assertEquals(3, $categories->count());
    }
    
     /**
     * @test
     *
     * @return void
     */
    public function list_of_categories_for_menu_display()
    {
    	$new_categories = factory(Category::class, 3)->create();
    	
    	foreach($new_categories as $category)
    	{
    		$category->articles()->saveMany(factory(App\Blog\Article::class, 3)->create());
    	}

        $categories = Category::listingWithArticleCount();

        $this->assertEquals(3, $categories->count());

        $this->assertEquals(3, $categories->first()->article_count);
    }
}
