<?php

namespace App\Http\Controllers\Frontend\Blog;

use Illuminate\Http\Request;
use App\Blog\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $category;

    function __construct(Category $category)
    {
    	$this->category = $category;
    }

    public function listWithCount()
    {
    	$categories = $this->category->listingWithArticleCount();
    	
    	return view('frontend.blog.category.index', compact('categories'));
    }
}
