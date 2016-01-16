<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Markets\Repository\ItemImageRepository;

class ItemImageController extends Controller
{
	protected $itemImage;

	function __construct(ItemImageRepository $itemImage)
	{
		$this->itemImage = $itemImage;
	}

    public function store(Request $request)
    {
    	$this->itemImage->onItemCreate($request);
    }

    public function main(Request $request)
    {
        $this->itemImage->main($request);

        return back();
    }

    public function remove(Request $request)
    {
        $this->itemImage->remove($request);

        return back();
    }
}
