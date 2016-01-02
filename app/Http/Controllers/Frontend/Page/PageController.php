<?php

namespace App\Http\Controllers\Frontend\Page;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home()
    {
    	return view('frontend.page.index');
    }
}
