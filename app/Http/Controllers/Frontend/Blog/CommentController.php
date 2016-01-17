<?php

namespace App\Http\Controllers\Frontend\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CommentForm;
use App\Blog\Repository\CommentReposiotry;

class CommentController extends Controller
{
    protected $comment;

    function __construct(CommentReposiotry $comment)
    {
    	$this->comment = $comment;
    }

    public function add(Request $request)
    {
    	$comment = $this->comment->add($request);

    	return $comment;
    }

    public function hide(Request $request)
    {
    	$comment = $this->comment->hide($request);

    	return $comment;
    }

    public function unHide(Request $request)
    {
    	$comment = $this->comment->unHide($request);

    	return $comment;
    }

    public function update(Request $request)
    {
    	$comment = $this->comment->submitUpdate($request);

    	return $comment;
    }

    public function remove(Request $request)
    {
    	$this->comment->remove($request);
    }
}
