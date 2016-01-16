<?php

namespace App\Markets;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
    * DB Table
    */
    protected $table = 'market_items';

    /**
    * Fillable columns on mass assignment
    */
    protected $fillable = ['slug', 'title', 'description'];

    /**
    * Relationship to ImageItem Model (one to many)
    */
    public function images()
    {
    	return $this->hasMany(ItemImage::class);
    }
}
