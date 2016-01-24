<?php

namespace App\Http\Controllers\Backend\Gallery;

use Illuminate\Http\Request;
use App\Gallery\Photo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    protected $photo;

    function __construct(Photo $photo)
    {
    	$this->photo = $photo;
    }

    public function store(Request $request)
    {
    	$this->photo->upload($request);

    	return back();
    }

    public function update(Request $request)
    {
    	$this->photo->submitUpdate($request);

    	return back();
    }

    public function remove(Request $request)
    {
    	$this->photo->remove($request);

    	return back();
    }
}
