<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Markets\Repository\ItemRepository;
use App\Markets\Repository\TypeRepository;
use App\Markets\Repository\MarketRepository;

class MarketController extends Controller
{
    protected $market;

    protected $type;

    function __construct(MarketRepository $market, TypeRepository $type)
    {
        $this->market = $market;
        $this->type = $type;
    }

    public function index()
    {
        $markets = $this->market->allWithTypeAndTimes();

    	return view('backend.market.index', compact('markets'));
    }

    public function create(ItemRepository $item)
    {
        $types = $this->type->selectList();
        $items = $item->allWithImagesPaginated();

    	return view('backend.market.create', compact('types', 'items'));
    }

    public function edit($id)
    {
        $market = $this->market->findById($id);
        $types  = $this->type->selectList();

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
