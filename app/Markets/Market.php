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

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    /**
    * Querys and Query Scopes
    */

    public function scopeCurrentAndFutureCount($query)
    {
        return $query->where('end_at', '>', Carbon::now())->count();
    }
    public function latest($take = 3)
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

    public function scopeFindById($query, $id)
    {
        return $query->with('type', 'times')->find($id);
    }

    public function scopeAllWithTypeAndTimes($query)
    {
        return $query->with('type', 'times')->get();
    }

    public function addNew($request)
    {
        $market = $this->create([
            'type_id'     => $request->type_id,
            'slug'        => str_slug($request->title),
            'title'       => $request->title,
            'description' => $request->description,
            'start_at'    => $request->start_at,
            'end_at'      => $request->end_at,
        ]);

        $this->attachTimes($market, $request);

        return $market;
    }

    public function submitUpdate($request)
    {
        $market = $this->find($request->id);
        $market->update([
            'type_id'     => $request->type_id,
            'slug'        => str_slug($request->title),
            'title'       => $request->title,
            'description' => $request->description,
            'start_at'    => $request->start_at,
            'end_at'      => $request->end_at,
        ]);

        $this->attachTimes($market, $request);

        return $market->load('times');
    }

    protected function attachTimes($market, $request)
    {
        $date = $market->start_at->toDateString();
        for($i = 0; $request->days > $i; $i++)
        {
            if($i > 0) {
                $date = $market->start_at->addDays($i)->toDateString();
            }
            Time::create([
                'market_id' => $market->id,
                'start' => Carbon::createFromFormat('Y-m-d h:i', $date.' '.$request->start_time[$i])->toDateTimeString(), 
                'end' => Carbon::createFromFormat('Y-m-d h:i', $date.' '.$request->end_time[$i])->toDateTimeString()
            ]);

        }
    }
}
