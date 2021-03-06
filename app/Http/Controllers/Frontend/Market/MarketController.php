<?php

namespace App\Http\Controllers\Frontend\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Markets\Repository\MarketRepository;

class MarketController extends Controller
{
    protected $market;

    function __construct(MarketRepository $market)
    {
    	$this->market = $market;
    }

    public function index()
    {
    	$markets = $this->market->upcoming();

    	return view('frontend.market.index', compact('markets'));
    }

    public function past()
    {
    	$markets = $this->market->past();

    	return view('frontend.market.index', compact('markets'));
    }

    public function show($slug)
    {
    	$market = $this->market->bySlug($slug);

    	return view('frontend.market.show', compact('market'));
    }

    public function type(Request $request)
    {
    	$markets = $this->market->byType($request->type_id);

    	return view('frontend.market.index', compact('markets'));
    }
}
