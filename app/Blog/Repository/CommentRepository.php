<?php

namespace App\Blog\Repository;

use App\Blog\Comment;

class CommentRepository
{
	protected $comment;

	function __construct(Comment $comment)
	{
		$this->comment = $comment;
	}

	protected function findByArticleId($article_id)
	{
		return $this->comment->with(['user' => function($query) {
					$query->select('id', 'avatar', 'username');
			   }])->where('article_id', $article_id)->latest();
	}

	public function newestByArticleId($article_id, $take = 4)
	{
		return $this->findByArticleId($article_id)->take($take)->get();
	}

	public function allByArticleId($article_id)
	{
		return $this->findByArticleId($article_id)->get();
	}

	public function add($request)
	{
		$comment = $this->comment->create([
			'user_id' 	 => auth()->id(),
			'article_id' => $request->article_id,
			'body' 	     => $request->body,
		]);
		return $comment->load('user');
	}

	public function submitUpdate($request)
	{
		$comment = $this->comment->find($request->id);
		$comment->update($request->all());
		return $comment;
	}

	public function hide($request)
	{
		$comment = $this->comment->find($request->id);
		if($comment->hidden == 1)
		{
			return $comment;
		}
		$comment->update(['hidden' => 1]);
		return $comment;
	}

	public function unHide($request)
	{
		$comment = $this->comment->find($request->id);
		if($comment->hidden == 1)
		{
			return $comment->update(['hidden' => 0]);
		}
		return $comment;
	}

	public function remove($request)
	{
		$this->comment->find($request->id)->delete();
	}
}