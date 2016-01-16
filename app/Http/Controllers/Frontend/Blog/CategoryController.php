<?php

namespace App\Http\Controllers\Frontend\Blog;

use App\Http\Controllers\Controller;
use App\Blog\Repository\CategoryRepository;

class CategoryController extends Controller
{
    protected $category;

    function __construct(CategoryRepository $category)
    {
    	$this->category = $category;
    }

    public function listWithCount()
    {
    	$categories = $this->category->listingWithArticleCount();
    	
    	return view('frontend.blog.category.index', compact('categories'));
    }
}
