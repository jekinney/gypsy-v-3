<?php

namespace App\Blog\Repository;

use Carbon\Carbon;
use App\Blog\Image;

class ImageRepository
{
	protected $image;

	function __construct(Image $image)
	{
		$this->image = $image;
	}

	public function listing()
	{
		return $this->image->get();
	}

	public function paginatedList($page = 10)
	{
		return $this->image->paginate($page);
	}

	public function addNew($request)
	{
		$file_data = $this->uploadImage($request);
        $this->image->create([
        	'title' => $request->has('title')? $request->title:str_random(10),
        	'thumbnail' => '/images/article/images/thumbnail'.$file_data['new_name'].'.'.$file_data['extention'],
        	'original' => '/images/article/images/'.$file_data['new_name'].'.'.$file_data['extention'],
        ]);
	}

	public function updateTitle($request)
	{
		$this->image->find($request->id)->update(['title' => $request->title]);
	}

	public function remove($request)
	{
		$image = $this->image->find($request->id);
		unlink(public_path().$image->thumbnail);
		unlink(public_path().$image->original);
		$image->delete();
	}

	protected function uploadImage($request)
    {
        $file = $request->file('file');
        $path = public_path().'/images/article/images/';
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        $new_name = strtolower(str_random(5).Carbon::now()->timestamp);
        $extention = $file->getClientOriginalExtension();
        \Image::make($path.$name)->resize(null, 900, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($path.$new_name.'.'.$extention);
        \Image::make($path.$name)->resize(250, 250)->save($path.'thumbnail'.$new_name.'.'.$extention);
        unlink($path.$name);
        return ['new_name' => $new_name, 'extention' => $extention];
    }
}
