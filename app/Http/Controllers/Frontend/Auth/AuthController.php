<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginForm;
use App\Http\Requests\User\RegistrationForm;

class AuthController extends Controller
{
    protected $user;

	function __construct(User $user)
	{
		$this->user = $user;
		$this->middleware('guest', ['except' => 'logout']);
	}

	public function login(LoginForm $request)
	{
		if(auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember')))
		{
			return redirect()->intended();
		}
		return back()->withInput()->withErrors('Password or email was incorrect');
	}

	public function register()
	{
		return view('frontend.auth.register');
	}

	public function postRegister(RegistrationForm $request)
	{
		$this->user->register($request);

		return redirect('/');
	}

	public function logout()
	{
		auth()->logout();

		return redirect('/');
	}
}
