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
        return $this->with('images')->get();
    }

}
