<?php

namespace App\Blog;

use DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'category_id', 'user_id',
        'header_image', 'slug', 
        'title', 'snippet', 'body', 
        'draft', 'publish_at'
    ];

    protected $dates = ['publish_at'];

    public function setSlugAttribute($slug)
    {
        return $this->attributes['slug'] = str_slug($slug);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id', 'id')->select(['id', 'title']);
    }

    public function author()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'username']);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePublishedCountWithCommentCount($query)
    {
        return $query->with(['comments' => function($q) {
                    $q->select(DB::raw('count(id) as comment_count'))
                      ->where('hidden', 0);
                }])->where('draft', 0)->where('publish_at', '<', Carbon::now())->count();
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

    public function scopeUnpublished($query)
    {
        return $query->with('category')->where('draft', 1)->orWhere('publish_at', '>', Carbon::now())->get();
    }

    public function scopePublished($query)
    {
        return $query->with('category')->where('draft', 0)->where('publish_at', '<', Carbon::now())->get();
    }

    public function scopeFindById($query, $id)
    {
        return $query->with('category')->find($id);
    }

    public function addNew($request)
    {
        $header = $this->upload($request);

        return $this->create([
            'user_id'     => 1,
            'category_id' => $request->category_id,
            'header_image'=> $header,
            'title'       => trim($request->title),
            'slug'        => trim($request->title),
            'snippet'     => trim($request->snippet),
            'body'        => $request->body,
            'draft'       => $request->has('draft')? 1:0,
            'publish_at'  => $request->publish_at,
        ]);
    }

    public function submitUpdate($request)
    {
        $article = $this->find($request->id);
        $header  = $this->upload($request, $article);
        $article->update([
            'user_id'     => 1,
            'category_id' => $request->category_id,
            'header_image'=> $header? $header:$article->header_image,
            'title'       => trim($request->title),
            'slug'        => trim($request->title),
            'snippet'     => trim($request->snippet),
            'body'        => $request->body,
            'draft'       => $request->has('draft')? 1:0,
            'publish_at'  => $request->publish_at,
        ]);
        return $article;
    }

    protected function addToRead($article)
    {
        $count = $article->reads;
    	$article->reads = $count + 1;
    	$article->save();
    }

    protected function upload($request, $article = null)
    {
        if($request->hasFile('header_image')) 
        {
            $file = $request->file('header_image');
            $path = public_path().'/images/article/headers/';
            $name = $file->getClientOriginalName();

            if($article) 
            {
                if($article->header_image == $path.$name)
                {
                    return $article->header_image;
                }

                if(file_exists(public_path().'/'.$article->header_image))
                {
                    unlink(public_path().'/'.$article->header_image);
                }
            }
            $file->move($path, $name);
            return 'images/article/headers/'.$name;
        } 
        return null;
    }
}
