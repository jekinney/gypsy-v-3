<?php

namespace App\Markets\Repository;

use App\Markets\Item;
use App\Markets\ItemImage;

class ItemRepository
{
	protected $item;

	function __construct(Item $item)
	{
		$this->item = $item;
	}

 	public function selectListWithMainImage($limit = 10)
    {
    	return $this->item
    			->with(['images' => function($q) {
    				$q->where('main', 1);
    			}])->paginate($limit);
    }

    public function allWithImagesPaginated($limit = 10)
    {
        return $this->item
        		->with('images')
        		->paginate($limit);
    }

    public function findByIdWithImages($id)
    {
        return $this->item
        		->with('images')
        		->find($id);
    }

    public function findBySlugWithImages($slug)
    {
        return $this->item
        		->with('images')
        		->where('slug', $slug)
        		->first();
    }

    public function addNew($request)
    {
        $item = $this->item
        		->create([
            		'slug'        => str_slug($request->title),
            		'title' 	  => $request->title,
            		'description' => $request->description
        		]);
        $this->temporaryPhotoCheck($item);
        return $item;
    }

    public function submitUpdate($request)
    {
        $item = $this->item->find($request->id);
        $item->update([
            'slug' 		  => str_slug($request->title),
            'title' 	  => $request->title,
            'description' => $request->description
        ]);
         $this->temporaryPhotoCheck($item);
        return $item;
    }

    public function remove($request)
    {
        $item = $this->item
        		->with('images')
        		->find($request->id);
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