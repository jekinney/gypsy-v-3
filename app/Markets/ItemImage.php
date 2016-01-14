<?php

namespace App\Markets;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    protected $fillable = ['item_id', 'path', 'order', 'main'];

    public function items()
    {
    	return $this->belongsTo(Item::class);
    }

    public function scopeMainImage($query)
    {
    	return $query->where('main', 1);
    }
}
