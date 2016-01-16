<?php

namespace App\Markets\Repository;

use Image;
use Carbon\Carbon;
use App\Markets\ItemImage;

class ItemImageRepository
{
	protected $image;

	function __construct(ItemImage $image)
	{
		$this->image = $image;
	}

    public function onItemCreate($request)
    {
    	$file_data = $this->fileUpload($request);
        $this->image->create([
        	'thumbnail' => '/images/market/items/thumbnail'.$file_data['new_name'].'.'.$file_data['extention'],
        	'large' => '/images/market/items/'.$file_data['new_name'].'.'.$file_data['extention'],
        	'order' => 0,
        ]);
    }

    public function onItemUpdate($request)
    {
        $file_data = $this->fileUpload($request);
        $this->image->create([
            'item_id' => $request->id,
            'thumbnail' => '/images/market/items/thumbnail'.$file_data['new_name'].'.'.$file_data['extention'],
            'large' => '/images/market/items/'.$file_data['new_name'].'.'.$file_data['extention'],
            'order' => $request->order,
        ]);
    }

    public function remove($request)
    {
        $image = $this->image->find($request->id);
        unlink(public_path().$image->thumbnail);
        unlink(public_path().$image->large);
        $image->delete();
    }

    public function main($request)
    {
        $image = $this->image->find($request->id);
        $main  = $this->image->where('item_id', $image->item_id)->where('main', 1)->first();
        if($main)
        {
            $main->update(['main' => 0]);
        }
        $image->update(['main' => 1]);
    }

    protected function fileUpload($request)
    {
        $file = $request->file('file');
        $path = public_path().'/images/market/items/';
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        $new_name = strtolower(str_random(5).Carbon::now()->timestamp);
        $extention = $file->getClientOriginalExtension();
        Image::make($path.$name)->resize(null, 900, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($path.$new_name.'.'.$extention);
        Image::make($path.$name)->resize(250, 250)->save($path.'thumbnail'.$new_name.'.'.$extention);
        unlink($path.$name);
        return ['new_name' => $new_name, 'extention' => $extention];
    }
}