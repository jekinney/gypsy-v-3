<?php

namespace App\Markets;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    /**
    * DB table
    */
    protected $table = 'market_markets';

    /**
    * Fillable columns on mass assignment
    */
    protected $fillable = ['type_id', 'title', 'slug', 'description', 'start_at', 'end_at'];

    /**
    * Add dates as Carbon Instances
    */
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
}
