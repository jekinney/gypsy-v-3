<?php

namespace App\Markets;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'market_types';
    
    protected $fillable = ['title', 'slug', 'image', 'description', 'location'];

    public function markets()
    {
    	return $this->hasMany(Market::class);
    }
}
