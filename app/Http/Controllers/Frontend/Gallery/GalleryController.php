<?php

namespace App\Http\Controllers\Frontend\Gallery;

use Illuminate\Http\Request;
use App\Gallery\Album;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
  protected $album;

  function __construct(Album $album)
  {
    $this->album = $album;
  }

  public function index()
  {
    $albums = $this->album->allWithPhotos();

  	return view('frontend.gallery.index', compact('albums'));
  }
}
