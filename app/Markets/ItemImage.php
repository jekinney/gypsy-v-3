<?php

namespace App\Markets;

use Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    protected $fillable = ['item_id', 'thumbnail', 'large', 'order', 'main'];

    public function items()
    {
    	return $this->belongsTo(Item::class);
    }

    public function scopeMainImage($query)
    {
    	return $query->where('main', 1);
    }

    public function tempFileUpload($request)
    {
    	$file = $request->file('file');
        $path = public_path().'/images/market/items/temporary/';
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        $new_name = strtolower(str_random(5).Carbon::now()->timestamp);
        $extention = $file->getClientOriginalExtension();
        \Image::make($path.$name)->resize(null, 900, function($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		})->save($path.$new_name.'.'.$extention);
        Image::make($path.$name)->resize(250, 250)->save($path.'thumbnail'.$new_name.'.'.$extention);
        unlink($path.$name);

        $this->create([
        	'thumbnail' => '/images/market/items/temporary/thumbnail'.$new_name.'.'.$extention,
        	'large' => '/images/market/items/temporary/'.$new_name.'.'.$extention,
        	'order' => 0,
        ]);
    }
}
