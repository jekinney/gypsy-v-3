<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Blog\Repository\CategoryRepository;
use App\Http\Requests\Blog\Category\CreateForm;
use App\Http\Requests\Blog\Category\UpdateForm;

class CategoryController extends Controller
{

	protected $category;

	function __construct(CategoryRepository $category)
	{
		$this->category = $category;
	}

    public function listing()
    {
    	$categories = $this->category->listingWithArticleCount();

    	return view('backend.blog.category.list', compact('categories'));
    }

    public function store(CreateForm $request)
    {
    	$this->category->addNew($request);

    	return back();
    }

    public function update(UpdateForm $request)
    {
    	$this->category->submitUpdate($request);

    	return back();
    }

    public function remove($id)
    {
    	$this->category->remove($id);

    	return back();
    }
}
