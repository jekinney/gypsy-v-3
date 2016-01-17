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

	public function add($request)
	{
		return $this->comment->create($request->all());
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