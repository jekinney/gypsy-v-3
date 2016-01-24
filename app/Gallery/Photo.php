<?php

namespace App\Gallery;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'gallery_photos';

    protected $fillable = ['album_id', 'thumbnail', 'image', 'description'];

    public function album()
    {
      return $this->belongsTo(Album::class);
    }

    public function upload($request)
    {
    	if($request->hasFile('file'))
    	{
    		$file_data = $this->uploadFiles($request);
        	return $this->create([
	        	'album_id'    => $request->album_id,
	        	'thumbnail'   => '/images/albums/'.$request->album_id.'/'.'thumbnail'.$file_data['new_name'].'.'.$file_data['extention'],
	        	'image'       => '/images/albums/'.$request->album_id.'/'.$file_data['new_name'].'.'.$file_data['extention'],
	        	'description' => $request->description,
	        ]);
    	}
    	return abort(415);
    }

    public function submitUpdate($request)
    {
    	return $this->find($request->id)->update($request->all());
    }

    public function remove($request)
	{
		$photo = $this->find($request->id);
		unlink(public_path().$photo->thumbnail);
		unlink(public_path().$photo->image);
		$photo->delete();
	}

	private function uploadFiles($request)
	{

		$file = $request->file('file');
    	$path = public_path().'/images/albums/'.$request->album_id.'/';
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
