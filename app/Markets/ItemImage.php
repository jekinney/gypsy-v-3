<?php

namespace App\Markets;

use Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    protected $table = 'market_images';

    protected $fillable = ['item_id', 'thumbnail', 'large', 'order', 'main'];

    public function items()
    {
    	return $this->belongsTo(Item::class);
    }

    public function scopeMainImage($query)
    {
    	return $query->where('main', 1);
    }
}
