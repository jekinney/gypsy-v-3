<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\User\Password\UpdateForm;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
	protected $user;

	function __construct(User $user)
	{
		$this->user = $user;
    	$this->middleware('guest', ['except' => 'update']);
    }

    public function update(UpdateForm $request)
    {
    	$this->user->updatePassword($request);

    	return back();
    }
}
