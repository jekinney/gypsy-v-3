<?php

namespace App\Http\Controllers\Backend\Gallery;

use Illuminate\Http\Request;
use App\Gallery\Album;
use App\Http\Requests\Gallery\Album\NewAlbumForm;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
  protected $album;

  function __construct(Album $album)
  {
    $this->album = $album;
  }

  public function index()
  {
    $albums = $this->album->allWithPhotos();

    return view('backend.gallery.index', compact('albums'));
  }

  public function show($id)
  {
    $album = $this->album->findByIdWithPohtos($id);

    return view('backend.gallery.show', compact('album'));
  }

  public function store(NewAlbumForm $request)
  {
    $this->album->addNew($request);

    return back();
  }

  public function update(NewAlbumForm $request)
  {
    $this->album->submitUpdate($request);

    return back();
  }
}
