<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;
use App\Markets\Item;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
     protected $item;

    function __construct(Item $item)
    {
    	$this->item = $item;
    }

    public function index()
    {
    	$types = $this->item->allWithImagesPaginated();

    	return view('backend.market.item.index', compact('items'));
    }

    public function store(CreateForm $request)
    {
    	$this->item->addNew($request);

    	return back();
    }

    public function update(UpdateForm $request)
    {	
    	$this->item->submitUpdate($request);

    	return back();
    }

    public function remove($id)
    {
    	$this->item->remove($id);

    	return back();
    }
}