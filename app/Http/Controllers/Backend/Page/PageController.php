<?php

namespace App\Http\Controllers\Backend\Page;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
    	return view('backend.page.index');
    }
}
