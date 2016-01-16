<?php

namespace App\Http\Controllers\Backend\Page;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog\Repository\ArticleRepository;
use App\Markets\Repository\MarketRepository;

class PageController extends Controller
{
    public function index(ArticleRepository $article, MarketRepository $market)
    {
    	$article_counts = $article->publishedCountWithCommentCount();
    	$user_count = \App\User::count();
    	$event_count = $market->currentAndFutureCount();

    	return view('backend.page.index', compact('article_counts', 'user_count', 'event_count'));
    }
}
