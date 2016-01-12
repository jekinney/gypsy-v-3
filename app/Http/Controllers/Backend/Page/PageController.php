<?php

namespace App\Http\Controllers\Backend\Page;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
    	$article_counts = \App\Blog\Article::publishedCountWithCommentCount();
    	$user_count = \App\User::count();
    	$event_count = \App\Markets\Market::CurrentAndFutureCount();

    	return view('backend.page.index', compact('article_counts', 'user_count', 'event_count'));
    }
}
