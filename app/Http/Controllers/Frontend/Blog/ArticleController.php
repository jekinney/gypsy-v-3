<?php

namespace App\Http\Controllers\Frontend\Blog;

use App\Blog\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
	protected $article;

	function __construct(Article $article)
	{
		$this->article = $article;
	}

    public function index()
    {
        $articles = $this->article->allPaginated(5);

        return view('frontend.blog.article.index', compact('articles'));
    }

    public function tenRecent()
    {
    	$articles = $this->article->tenRecent();

    	return view('frontend.blog.article.ten', compact('articles'));
    }

    public function topTen()
    {
    	$articles = $this->article->topTen();

    	return view('frontend.blog.article.ten', compact('articles'));
    }

    public function show($slug)
    {
    	$article = $this->article->showBySlug($slug);

    	return view('frontend.blog.article.show', compact('article'));
    }
}
