<?php

namespace App\Http\Controllers\Frontend\Auth;

use Socialite;
use App\SocialProvider;
use App\Http\Controllers\Controller;

class GoogleController extends Controller
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
        return Socialite::driver('google')->redirect();
    }

    /**
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
    public function callback()
    {
        $google = Socialite::driver('google')->user();
        $user     = $this->social->google($google);
        if($user)
        {
        	return redirect()->route('account.index');
        }
        return redirect()->intended('/');
    }	
}
