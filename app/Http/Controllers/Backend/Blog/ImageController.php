<?php

namespace App\Http\Controllers\Backend\Blog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog\Repository\ImageRepository;

class ImageController extends Controller
{
    protected $image;

    function __construct(ImageRepository $image)
    {
    	$this->image = $image;
    }

    public function index()
    {
    	$images = $this->image->listing();

    	return view('backend.blog.image.index', compact('images'));
    }

    public function store(Request $request)
    {
    	$this->image->addNew($request);

    	return back();
    }

    public function update(Request $request)
    {
    	$this->image->updateTitle($request);

    	return back();
    }

    public function remove(Request $request)
    {
    	$this->image->remove($request);

    	return back();
    }
}
