<?php

namespace App\Markets;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = ['market_id', 'start', 'end'];

    protected $dates = ['start', 'end'];

    public function market()
    {
    	return $this->belongsTo(Market::class);
    }
}
