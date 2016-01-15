<?php

namespace App\Http\Controllers\Backend\Market;

use Illuminate\Http\Request;
use App\Markets\ItemImage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemImageController extends Controller
{
	protected $itemImage;

	function __construct(ItemImage $itemImage)
	{
		$this->itemImage = $itemImage;
	}

    public function store(Request $request)
    {
    	$this->itemImage->tempFileUpload($request);
    }
}
