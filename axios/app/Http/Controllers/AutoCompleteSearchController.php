<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoCompleteSearchController extends Controller
{
    public function index()
    {
        return view('auto_complete_search');
    }
}
