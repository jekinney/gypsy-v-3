<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description'];

    public function articles()
    {
    	return $this->hasMany(Article::class);
    }

    public function scopeSelectList($query)
    {
    	return $query->get(['title']);
    }

    public function scopeList($query)
    {
    	return $query->get(['title', 'description']);
    }

    public function scopeListWithArticleCount($query)
    {
    	$categories = $query->get(['title']);

        foreach($categories as $category)
        {
            $cat = $category->load(['articles' => function($q) {
                $q->select(['id']);
            }]);

            $category = array_add($category, 'count', $cat->articles->count());
            $category = array_except($category, ['articles']);
        }

        return $categories;
    }
}
