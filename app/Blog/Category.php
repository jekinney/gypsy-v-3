<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * Set DB Table
    */
    protected $table = 'blog_categories';

    /**
    * Fillable columns on mass assignment
    */
    protected $fillable = ['slug', 'title', 'description'];

    /**
    * Relationship to Article Model (many to one)
    */
    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
