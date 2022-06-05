<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AutoCompleteSearchController extends Controller
{
    public function index()
    {
        return view('auto_complete_search');
    }

    public function getSearchData(Request $request)
    {
        $products = Product::where('title', 'LIKE', '%' . $request->searchValue . '%')->get();
        return $products;
    }
}
