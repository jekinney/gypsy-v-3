<?php

namespace App\Http\Controllers\Frontend\Gallery;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
    	return view('frontend.gallery.index');
    }

    public function show()
    {

    }
}
