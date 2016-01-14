<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Blog\Article;
use App\Markets\Market;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home(Market $market, Article $article)
    {
    	$markets  = $market->latest(3);
    	$articles = $article->latest();

    	return view('frontend.page.index', compact('markets', 'articles'));
    }
}
