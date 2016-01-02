<?php

namespace App\Markets;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    /**
    * Overides and defaults from base model
    */
    protected $fillable = ['type_id', 'title', 'slug', 'description', 'start_at', 'end_at'];

    protected $dates = ['start_at', 'end_at'];

    /**
    * Attributes to columns in database
    */
    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = str_slug($slug);
    }

    /**
    * Relationships to other models
    */
    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function times()
    {
    	return $this->hasMany(Time::class);
    }

    /**
    * Querys and Query Scopes
    */

    public function soonest($take = 2)
    {
        return $this->with('type', 'times')->orderBy('end_at', 'desc')->take($take)->get();
    }
    public function upcoming()
    {
        return $this->with('type', 'times')->where('end_at', '>', Carbon::now())->paginate(6);
    }

    public function past()
    {
        return $this->with('type', 'times')->where('end_at', '<', Carbon::now())->paginate(6);
    }

    public function bySlug($slug)
    {
        return $this->with('type', 'times')->where('slug', $slug)->first();
    }

    public function byType($type_slug)
    {
        return $this->has(['type' => function($q) {
                    $q->where('slug', $type_slug);
                }])->with('times')->paginate(6);
    }
}
