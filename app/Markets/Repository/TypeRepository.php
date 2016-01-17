<?php

namespace App\Markets\Repository;

use App\Markets\Type;

class TypeRepository
{
	protected $type;

	function __construct(Type $type)
	{
		$this->type = $type;
	}

	 public function listWithMarketCount()
    {
        return $this->type->with('markets')->get();
    }

    public function selectList()
    {
    	return $this->type->get(['id', 'title']);
    }

    public function addNew($request)
    {
        $image = $this->uploadImage($request);

        return $this->type->create([
            'image'       => $image,
            'title'       => $request->title,
            'slug'        => str_slug($request->title),
            'description' => $request->description,
            'location'    => $request->location
        ]);
    }

    public function submitUpdate($request)
    {
        $type  = $this->type->find($request->id);
        $image = $this->uploadImage($request, $type);
        $type->update([
            'image'       => $image,
            'title'       => $request->title,
            'slug'        => str_slug($request->title),
            'description' => $request->description,
            'location'    => $request->location
        ]);
        return $type;
    }

    public function remove($id)
    {
        $this->type->find($id)->delete();
    }

    protected function uploadImage($request, $type = null)
    {
        if($request->hasFile('image')) 
        {
            $file = $request->file('image');
            $path = public_path().'/images/market/type/';
            $name = $file->getClientOriginalName();

            if($type) 
            {
                if($type->image == $path.$name)
                {
                    return $type->image;
                }

                if($type->image && file_exists(public_path().'/'.$type->image))
                {
                    unlink(public_path().'/'.$type->image);
                }
            }
            $file->move($path, $name);
            return 'images/market/type/'.$name;
        }
        elseif($type)
        {
            return $type->image;
        }
        return null;
    }
}