<?php

namespace App\Http\ViewComposers\Blog;

use App\Blog\Repository\CategoryRepository;
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
    public function __construct(CategoryRepository $category)
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
        $view->with('categories', $this->category->listingWithArticleCount());
    }
}