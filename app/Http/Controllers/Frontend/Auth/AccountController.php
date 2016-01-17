<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    protected $user;

    function __construct(User $user)
    {
    	$this->user = $user;
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('frontend.auth.account.index');
    }

    public function updateNewsletter()
    {
        $this->user->updateNewsletter();

        return back();
    }
}
