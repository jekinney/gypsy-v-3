<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\User;
use Socialite;
use App\Http\Controllers\Controller;

class FacebookController extends Controller
{
	protected $user;

	function __construct(User $user)
	{
		$this->user = $user;
        $this->middleware('guest');
	}

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function provider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
    public function callback()
    {
        $facebook = Socialite::driver('facebook')->user();
        $user     = $this->user->socialMedia($facebook);
        if($user)
        {
        	return redirect()->route('account.index');
        }
        return redirect()->intended('/');
    }	
}
