<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function getHelpPage()
    {
    	return view('bana.helpPage');
    }
}
