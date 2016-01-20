<?php

namespace App\Blog;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'blog_comments';
	
    protected $fillable = ['article_id', 'user_id', 'body', 'hidden'];

    public function article()
    {
    	return $this->belongsTo(Article::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
