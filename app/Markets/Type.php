<?php

namespace App\Markets;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['title', 'slug', 'image', 'description', 'location'];

    public function setSlugAttribute($slug)
    {
    	$this->attributes['slug'] = str_slug($slug);
    }

    public function market()
    {
    	return $this->hasMany(Market::class);
    }

    public function scopeSelectList($query)
    {
    	return $query->get();
    }
}
