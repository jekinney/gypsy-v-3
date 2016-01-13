<?php

namespace App\Markets;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['title', 'slug', 'image', 'description', 'location'];

    public function markets()
    {
    	return $this->hasMany(Market::class);
    }

    public function scopeListWithMarketCount($query)
    {
        return $query->with('markets')->get();
    }

    public function scopeSelectList($query)
    {
    	return $query->get();
    }

    public function addNew($request)
    {
        $image = $this->upload($request);

        return $this->create([
            'image'       => $image,
            'title'       => $request->title,
            'slug'        => str_slug($request->title),
            'description' => $request->description,
            'location'    => $request->location
        ]);
    }

    public function submitUpdate($request)
    {
        $type  = $this->find($request->id);
        $image = $this->upload($request, $type);
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
        $this->find($id)->delete();
    }

    protected function upload($request, $type = null)
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
