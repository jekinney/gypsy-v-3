<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description'];

    public function setSlugAttribute($slug)
    {
        return $this->attributes['slug'] = str_slug($slug);
    }

    public function articles()
    {
    	return $this->hasMany(Article::class);
    }

    public function scopeSelectList()
    {
    	return $this->get(['id', 'title']);
    }

    public function scopeListing()
    {
    	return $this->get(['title', 'slug', 'description']);
    }

    public function scopeListingWithArticleCount()
    {
    	return $this->with(['articles' => function($q) {
                  $q->select(['id']);
               }])->get();
    }
}
