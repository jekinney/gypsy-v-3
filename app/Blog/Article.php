<?php

namespace App\Blog;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'category_id', 'user_id', 
    	'slug', 'title', 'snippet', 
    	'body', 'draft', 'publish_at'
    ];

    protected $dates = ['publish_at'];

    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id', 'id')->select(['id', 'title']);
    }

    public function author()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'username']);
    }

    public function latest($take = 2)
    {
        return $this
            ->where('publish_at', '<', Carbon::now())
            ->where('draft', 0)
            ->orderBy('publish_at', 'desc')
            ->take($take)
            ->get();
    }

    public function scopeActive($query)
    {
    	return $query->where('publish_at', '<', Carbon::now())->where('draft', 0);
    }

    public function scopeTenRecent($query)
    {
    	return $query
    		->with('category', 'author')
    		->active()
    		->orderBy('publish_at', 'desc')
    		->take(10)
    		->get();
    }

    public function scopeTopTen($query)
    {
    	return $query  
    		->with('category', 'author')
    		->active()
    		->orderBy('reads', 'desc')
    		->take(10)
    		->orderBy('publish_at', 'desc')
    		->get();
    }

     public function scopeTenRecentTitles($query)
    {
        return $query
            ->active()
            ->orderBy('publish_at', 'desc')
            ->take(10)
            ->get(['title', 'reads']);
    }

    public function scopeTopTenTitles($query)
    {
        return $query  
            ->active()
            ->orderBy('reads', 'desc')
            ->take(10)
            ->orderBy('publish_at', 'desc')
            ->get(['title', 'reads']);
    }

    public function allPaginated($pagination = 10)
    {
    	return $this
    		->with('category', 'author')
    		->active()
    		->orderBy('publish_at', 'desc')
    		->paginate($pagination);
    }

    public function showBySlug($slug)
    {
    	$article = $this
    			->with('category', 'author')
    			->where('slug', $slug)
    			->first();
    	$this->addToRead($article);

    	return $article;
    }

    protected function addToRead($article)
    {
        $count = $article->reads;
    	$article->reads = $count + 1;
    	$article->save();
    }
}
