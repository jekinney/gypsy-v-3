<?php

namespace App\Markets;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['slug', 'title', 'description'];

    public function images()
    {
    	return $this->hasMany(ItemImage::class);
    }

    public function selectListWithMainImage($limit = 10)
    {
    	return $this->with(['images' => function($q) {
    				$q->where('main', 1);
    			}])->paginate($limit);
    }

    public function allWithImagesPaginated($limit = 10)
    {
        return $this->with('images')->paginate($limit);
    }

    public function findByIdWithImages($id)
    {
        return $this->with('images')->find($id);
    }

    public function findBySlugWithImages($slug)
    {
        return $this->with('images')->where('slug', $slug)->first();
    }

    public function addNew($request)
    {
        $item = $this->create([
            'slug' => str_slug($request->title),
            'title' => $request->title,
            'description' => $request->description
        ]);
        $this->temporaryPhotoCheck($item);
        return $item;
    }

    public function submitUpdate($request)
    {
        $item = $this->find($request->id);
        $item->update([
            'slug' => str_slug($request->title),
            'title' => $request->title,
            'description' => $request->description
        ]);
         $this->temporaryPhotoCheck($item);
        return $item;
    }

    public function remove($request)
    {
        $item = $this->with('images')->find($request->id);
        if($item->images->count() > 0)
        {
            foreach($item->images as $image)
            {
                unlink(public_path().$image->thumbnail);
                unlink(public_path().$image->large);
                $image->delete();
            }
        }
        $item->delete();

    }

    protected function temporaryPhotoCheck($item)
    {
        $photos = ItemImage::where('item_id', 0)->get();
        if($photos)
        {
            foreach($photos as $photo)
            {
                $photo->update(['item_id' => $item->id]);
            }
        }
    }

}
