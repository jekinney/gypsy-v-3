<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;

use App\Markets\Type;
use App\Markets\Market;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MarketController extends Controller
{
    protected $market;

    function __construct(Market $market)
    {
        $this->market = $market;
    }

    public function index()
    {
        $markets = $this->market->AllWithTypeAndTimes();

    	return view('backend.market.index', compact('markets'));
    }

    public function create()
    {
    	return view('backend.market.create');
    }

    public function edit($id, Type $type)
    {
        $market = $this->market->findById($id);
        $types  = $type->selectList();

    	return view('backend.market.edit', compact('market', 'types'));
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {
    	
    }
}
