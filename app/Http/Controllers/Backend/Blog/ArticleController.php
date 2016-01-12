<?php

namespace App\Http\Controllers\Backend\Blog;

use Illuminate\Http\Request;

use App\Blog\Article;
use App\Blog\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
	protected $article;

	function __construct(Article $article)
	{
		$this->article = $article;
	}
	
    public function create(Category $category)
    {
    	$categories = $category->selectList();

    	return view('backend.blog.article.create', compact('categories'));
    }

    public function edit($id, Category $category)
    {
    	$article = $this->article->findById($id);
    	$categories = $category->selectList();

    	return view('backend.blog.article.edit', compact('article', 'categories'));
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
