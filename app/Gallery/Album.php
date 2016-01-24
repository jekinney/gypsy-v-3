<?php

namespace App\Gallery;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'gallery_albums';

    protected $fillable = ['slug', 'name', 'description'];

    public function photos()
    {
      return $this->hasMany(Photo::class);
    }

    public function allWithPhotos()
    {
      return $this->with('photos')->get();
    }

    public function findByIdWithPohtos($id)
    {
      return $this->with('photos')->find($id);
    }

    public function addNew($request)
    {
      return $this->create([
        'slug' => str_slug($request->name),
        'name' => $request->name,
        'description' => $request->description,
      ]);
    }

    public function submitUpdate($request)
    {
      $album = $this->find($request->id);
      $album->update([
        'slug' => str_slug($request->name),
        'name' => $request->name,
        'description' => $request->description,
      ]);
      return $album;
    }
}
