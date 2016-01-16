<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Markets\Repository\ItemRepository;

class ItemController extends Controller
{
     protected $item;

    function __construct(ItemRepository $item)
    {
    	$this->item = $item;
    }

    public function index()
    {
    	$items = $this->item->allWithImagesPaginated();

    	return view('backend.market.item.index', compact('items'));
    }

    public function edit($id)
    {
        $item = $this->item->findByIdWithImages($id);

        return view('backend.market.item.edit', compact('item'));
    }

    public function store(Request $request)
    {
    	$this->item->addNew($request);

    	return back();
    }

    public function update(Request $request)
    {	
    	$this->item->submitUpdate($request);

    	return back();
    }

    public function remove(Request $request)
    {
    	$this->item->remove($request);

    	return back();
    }
}
