<?php

namespace App\Http\Controllers\Backend\Blog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog\Repository\ImageRepository;
use App\Blog\Repository\ArticleRepository;
use App\Blog\Repository\CategoryRepository;

class ArticleController extends Controller
{
	protected $article;

    protected $category;

    protected $image;

	function __construct(ArticleRepository $article, CategoryRepository $category, ImageRepository $image)
	{
		$this->article = $article;
        $this->category = $category;
        $this->image = $image;
	}
	
    public function create()
    {
    	$categories = $this->category->selectList();
        $images = $this->image->paginatedList(3);

    	return view('backend.blog.article.create', compact('categories', 'images'));
    }

    public function edit($id)
    {
    	$article = $this->article->findById($id);
    	$categories = $this->category->selectList();
        $images = $this->image->paginatedList(3);


    	return view('backend.blog.article.edit', compact('article', 'categories', 'images'));
    }

    public function unpublishedList()
    {
        $articles = $this->article->unpublished();
        $list_type = 'Unpublished and/or drafts';

        return view('backend.blog.article.list', compact('articles', 'list_type'));
    }

    public function publishedList()
    {
        $articles = $this->article->published();
        $list_type = 'published';

        return view('backend.blog.article.list', compact('articles', 'list_type'));
    }

    public function store(Request $request)
    {
        $this->article->addNew($request);

        return back();
    }

    public function update(Request $request)
    {
        $this->article->submitUpdate($request);

        return back();
    }
}
