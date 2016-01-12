<?php

namespace App\Http\Controllers\Backend\Blog;

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

    public function listing()
    {
    	$categories = $this->category->listingWithArticleCount();

    	return view('backend.blog.category.list', compact('categories'));
    }
}
