<?php

namespace App;

use App\Blog\Comment;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'social_id', 
        'avatar', 'password', 'newsletter',
        'is_admin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'code', 'activated', 'admin'
    ];

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }

    public function social()
    {
        return $this->hasMany(SocialProvider::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function add($request)
    {
        $this->username = $request->name;
        $this->email    = $request->email;
        if($request->has('password'))
        {
            $this->password = $request->password;
        }
        $this->newsletter = $request->has('newsletter')? 1:0;
        $this->save();
        return auth()->login($this);      
    }

    public function updatePassword($request)
    {
        $user = auth()->user();
        if($user->password)
        {
            if(!auth()->once(['email' => $user->email, 'password' => $request->current_password])) {
                return back()->withInput()->withErrors(['current_password' => 'Your current password is incorrect']);
            } 
        }
        $user->update(['password' => $request->password]);

        return $user;
    }

    public function updateNewsletter()
    {
        $user = auth()->user();
        $newsletter = 0;
        if($user->newsletter == 0)
        {
            $newsletter = 1;
        }
        $user->update(['newsletter' => $newsletter]);
    }
}
