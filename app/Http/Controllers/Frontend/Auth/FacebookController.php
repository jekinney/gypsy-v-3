<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\SocialProvider;
use Socialite;
use App\Http\Controllers\Controller;

class FacebookController extends Controller
{
	protected $social;

	function __construct(SocialProvider $social)
	{
		$this->social = $social;
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
        $user     = $this->social->facebook($facebook);
        if($user)
        {
        	return redirect()->route('account.index');
        }
        return redirect()->intended('/');
    }	
}
