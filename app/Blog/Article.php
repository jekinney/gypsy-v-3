<?php

namespace App\Blog;

use DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
    * Set DB Table
    */
    protected $table = 'blog_articles';

    /**
    * Fillable columns on mass assignment
    */
    protected $fillable = [
    	'category_id', 'user_id',
        'header_image', 'slug', 
        'title', 'snippet', 'body', 
        'draft', 'publish_at'
    ];

    /**
    * Add dates as Carbon instance
    */
    protected $dates = ['publish_at'];

    /**
    * Relationship to Category Model (one to many)
    */
    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id', 'id')->select(['id', 'title']);
    }

    /**
    *  Relationship to User Model (one to many)
    */
    public function author()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'username']);
    }

    /**
    *  Relationship to Comment Model (many to one)
    */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeActive()
    {
        return $this->where('publish_at', '<', Carbon::now())->where('draft', 0);
    }
}
