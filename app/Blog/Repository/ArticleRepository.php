<?php

namespace App\Blog\Repository;

use Carbon\Carbon;
use App\Blog\Article;

class ArticleRepository
{
	protected $article;

	function __construct(Article $article)
	{
		$this->article = $article;
	}

	public function publishedCountWithCommentCount()
    {
        return $this->article->with(['comments' => function($q) {
                    $q->select(DB::raw('count(id) as comment_count'))
                      ->where('hidden', 0);
                }])->where('draft', 0)->where('publish_at', '<', Carbon::now())->count();
    }

    public function latest($take = 2)
    {
        return $this->article
            ->where('publish_at', '<', Carbon::now())
            ->where('draft', 0)
            ->orderBy('publish_at', 'desc')
            ->take($take)
            ->get();
    }

    public function tenRecent()
    {
    	return $this->article
    		->with('category', 'author')
    		->active()
    		->orderBy('publish_at', 'desc')
    		->take(10)
    		->get();
    }

    public function topTen($query)
    {
    	return $this->article  
    		->with('category', 'author')
    		->active()
    		->orderBy('reads', 'desc')
    		->take(10)
    		->orderBy('publish_at', 'desc')
    		->get();
    }

     public function tenRecentTitles()
    {
        return $this->article
            ->active()
            ->orderBy('publish_at', 'desc')
            ->take(10)
            ->get(['title', 'reads']);
    }

    public function topTenTitles()
    {
        return $this->article  
            ->active()
            ->orderBy('reads', 'desc')
            ->take(10)
            ->orderBy('publish_at', 'desc')
            ->get(['title', 'reads']);
    }

    public function allPaginated($pagination = 10)
    {
    	return $this->article
    		->with('category', 'author')
    		->active()
    		->orderBy('publish_at', 'desc')
    		->paginate($pagination);
    }

    public function showBySlug($slug)
    {
    	$article = $this->article
    			->with('category', 'author')
    			->where('slug', $slug)
    			->first();
    	$this->addToRead($article);
    	return $article;
    }

    public function unpublished()
    {
        return $this->article->with('category')->where('draft', 1)->orWhere('publish_at', '>', Carbon::now())->get();
    }

    public function published()
    {
        return $this->article->with('category')->where('draft', 0)->where('publish_at', '<', Carbon::now())->get();
    }

    public function findById($id)
    {
        return $this->article->with('category')->find($id);
    }

    public function addNew($request)
    {
        $header = $this->uploadHeaderImage($request);
        return $this->article->create([
            'user_id'     => 1,
            'category_id' => $request->category_id,
            'header_image'=> $header,
            'title'       => $request->title,
            'slug'        => str_slug($request->title),
            'snippet'     => $request->snippet,
            'body'        => $request->body,
            'draft'       => $request->has('draft')? 1:0,
            'publish_at'  => $request->publish_at,
        ]);
    }

    public function submitUpdate($request)
    {
        $article = $this->article->find($request->id);
        $header  = $this->uploadHeaderImage($request, $article);
        $article->update([
            'user_id'     => 1,
            'category_id' => $request->category_id,
            'header_image'=> $header? $header:$article->header_image,
            'title'       => $request->title,
            'slug'        => str_slug($request->title),
            'snippet'     => $request->snippet,
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

    protected function uploadHeaderImage($request, $article = null)
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