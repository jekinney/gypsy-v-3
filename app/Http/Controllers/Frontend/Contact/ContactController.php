<?php

namespace App\Http\Controllers\Frontend\Contact;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
    	return view('frontend.contact.index');
    }

    public function store(Request $request)
    {
    	
    }
}
