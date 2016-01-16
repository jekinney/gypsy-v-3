<?php

namespace App\Markets\Repository;

use Carbon\Carbon;
Use App\Markets\Time;
use App\Markets\Market;

class MarketRepository
{
	protected $market;

	function __construct(Market $market)
	{
		$this->market = $market;
	}

	public function currentAndFutureCount()
    {
        return $this->market
        		->where('end_at', '>', Carbon::now())
        		->count();
    }
    public function latest($take = 3)
    {
        return $this->market
        		->with('type', 'times')
        		->orderBy('end_at', 'desc')
        		->take($take)
        		->get();
    }
    public function upcoming()
    {
        return $this->market
        		->with('type', 'times')
        		->where('end_at', '>', Carbon::now())
        		->paginate(6);
    }

    public function past()
    {
        return $this->market
        		->with('type', 'times')
        		->where('end_at', '<', Carbon::now())
        		->paginate(6);
    }

    public function bySlug($slug)
    {
        return $this->market
        		->with('type', 'times')
        		->where('slug', $slug)
        		->first();
    }

    public function byType($type_slug)
    {
        return $this->market
        		->has(['type' => function($q) {
                    $q->where('slug', $type_slug);
                }])->with('times')
                ->paginate(6);
    }

    public function findById($id)
    {
        return $this->market
        		->with('type', 'times')
        		->find($id);
    }

    public function AllWithTypeAndTimes()
    {
        return $this->market
        		->with('type', 'times')
        		->get();
    }

    public function addNew($request)
    {
        $market = $this->market->create([
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
        $market = $this->market->find($request->id);
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