<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['article_id', 'user_id', 'body', 'hidden'];

    public function article()
    {
    	return $this->belongsTo(Article::class);
    }

    public function user()
    {
    	return $this->belongsTo(App\User::class);
    }
}
