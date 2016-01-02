<?php

namespace App\Http\ViewComposers\Blog;

use App\Blog\Category;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * The Category Model.
     *
     * @var Category
     */
    protected $category;

    /**
     * Create a new profile composer.
     *
     * @param  Category  $category
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->category->listWithArticleCount());
    }
}