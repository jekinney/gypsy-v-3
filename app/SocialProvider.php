<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $fillable = ['user_id', 'provider', 'provider_id', 'email', 'avatar', 'primary'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function google($details)
    {
    	$details = array_add($details, 'provider', 'google');
    	if(auth()->guest())
    	{
	    	$google = $this->where('provider_id', $details->id)->first();
	    	if($google)
	    	{
	    		return auth()->login($google->user);
	    	}
	    	return $this->setUpNewUser($details);
	    }
    	$this->setUpLink($details);
    }

    public function facebook($details)
    {
    	$details = array_add($details, 'provider', 'facebook');
    	if(auth()->guest())
    	{
	    	$facebook = $this->where('provider_id', $details->id)->first();
	    	if($facebook)
	    	{
	    		return auth()->login($facebook->user);
	    	}
	    	return $this->setUpNewUser($details);
	    }
	    $this->setUpLink($details);
    }

    public function setPrimary($provider)
    {
    	$socials = auth()->user()->social();
    	foreach($socials as $social)
    	{
    		if($social->primary == 1)
    		{
    			$social->update(['primary' => 0]);
    		}
    	}
    	$social = $socials->where('provider', $provider)->first();
    	$social->update(['primary' => 1]);
    	return auth()->user()->update([
    			'username' => $social->name, 
    			'email' => $social->email, 
    			'avatar' => $social->avatar
    		]);
    }

    protected function setUpNewUser($details)
    {
    	$user = User::create([
    		'username' => $details->name,
    		'email'    => $details->email,
    		'avatar'   => $details->avatar,
    	]);
    	$this->addNew($details, $user);
    }

    protected function addNew($details, $user = null)
    {
    	if(auth()->check() && is_null($user))
    	{
    		return auth()->user()->social()->create([
    				'provider' 	  => $details->user['provider'],
    				'provider_id' => $details->id,
    				'email'       => $details->email,
    				'avatar'      => $details->avatar,
    			]);
    	}
    	$user->social()->create([
    		'provider'    => $details->user['provider'],
    		'provider_id' => $details->id,
    		'email'       => $details->email,
    		'avatar'      => $details->avatar,
    		'primary'     => 1
    	]);
    	return auth()->login($user);
    }
}
