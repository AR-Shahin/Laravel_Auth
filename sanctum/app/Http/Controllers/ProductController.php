<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::paginate(4);
    }

    public function show(Product $product)
    {
        return $product;
    }
}
