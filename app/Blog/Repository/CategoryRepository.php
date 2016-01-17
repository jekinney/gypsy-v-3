<?php

namespace App\Blog\Repository;

use App\Blog\Category;

class CategoryRepository
{
	protected $category;

	function __construct(Category $category)
	{
		$this->category = $category;
	}

	public function selectList()
    {
    	return $this->category->get(['id', 'title']);
    }

    public function listing()
    {
    	return $this->category->get(['title', 'slug', 'description']);
    }

    public function listingWithArticleCount()
    {
    	return $this->category
    			->with(['articles' => function($q) {
                  	$q->select(['id']);
               	}])->get();
    }

    public function addNew($request)
    {
        return $this->category->create([
            'slug'        => str_slug($request->title), 
            'title'       => $request->title, 
            'description' => $request->description,
        ]);
    }

    public function submitUpdate($request)
    {
        $category = $this->category->find($request->id);
        $category->update([
            'slug'        => str_slug($request->title), 
            'title'       => $request->title, 
            'description' => $request->description,
        ]);
        return $category;
    }

    public function remove($id)
    {
        $this->category->find($id)->delete();
    }
}