<?php

namespace App\Http\Controllers\Frontend\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CommentForm;
use App\Blog\Repository\CommentRepository;

class CommentAPIController extends Controller
{
    protected $comment;

    function __construct(CommentRepository $comment)
    {
    	$this->comment = $comment;
        $this->middleware('auth', ['except' => ['latest', 'all']]);
    }

    public function latest($id)
    {
        return $this->comment->newestByArticleId($id);
    }

    public function all($id)
    {
        return $this->comment->allByArticleId($id);
    }

    public function add(CommentForm $request)
    {
    	return $this->comment->add($request);
    }

    public function hide(Request $request)
    {
    	$this->comment->hide($request);
    }

    public function unHide(Request $request)
    {
    	$this->comment->unHide($request);
    }

    public function update(Request $request)
    {
    	return $this->comment->submitUpdate($request);
    }

    public function remove(Request $request)
    {
    	$this->comment->remove($request);
    }
}
