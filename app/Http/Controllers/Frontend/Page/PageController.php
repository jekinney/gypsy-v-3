<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use App\Blog\Repository\ArticleRepository;
use App\Markets\Repository\MarketRepository;

class PageController extends Controller
{
    public function home(MarketRepository $market, ArticleRepository $article)
    {
    	$markets  = $market->latest(3);
    	$articles = $article->latest();

    	return view('frontend.page.index', compact('markets', 'articles'));
    }
}
