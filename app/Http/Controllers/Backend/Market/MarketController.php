<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;

use App\Markets\Item;
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

    public function index(Item $item)
    {
        $markets = $this->market->AllWithTypeAndTimes();
        $items   = $this->item->selectListWithMainImage();

    	return view('backend.market.index', compact('markets', 'items'));
    }

    public function create(Type $type, Item $item)
    {
        $types = $type->selectList();
        $items = $item->selectListWithMainImage();

    	return view('backend.market.create', compact('types', 'items'));
    }

    public function edit($id, Type $type)
    {
        $market = $this->market->findById($id);
        $types  = $type->selectList();

    	return view('backend.market.edit', compact('market', 'types'));
    }

    public function store(Request $request)
    {
        $this->market->addNew($request);

        return back();
    }

    public function update(Request $request)
    {
    	
    }
}
