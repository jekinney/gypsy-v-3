<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Markets\Repository\TypeRepository;
use App\Http\Requests\Markets\Type\CreateForm;
use App\Http\Requests\Markets\Type\UpdateForm;

class TypeController extends Controller
{
    protected $type;

    function __construct(TypeRepository $type)
    {
    	$this->type = $type;
    }

    public function index()
    {
    	$types = $this->type->listWithMarketCount();

    	return view('backend.market.type.index', compact('types'));
    }

    public function store(CreateForm $request)
    {
    	$this->type->addNew($request);

    	return back();
    }

    public function update(UpdateForm $request)
    {	
    	$this->type->submitUpdate($request);

    	return back();
    }

    public function remove($id)
    {
    	$this->type->remove($id);

    	return back();
    }
}
