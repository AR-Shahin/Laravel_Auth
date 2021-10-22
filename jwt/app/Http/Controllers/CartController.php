<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return Cart::with('product')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $item = Cart::where('product_id', $request->product_id)->first();

        if ($item->count()) {
            $item->increment('quantity');
            $item = $item->first();
        } else {
            $item = Cart::forceCreate([
                'product_id' => $request->product_id,
                'user_id' => $request->user_id,
                'quantity' => 1,
            ]);
        }

        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product_id,
            'user_id' => $item->user_id,
        ]);
    }

    public function destroy($productId)
    {
        $item = Cart::where('product_id', $productId)->delete();

        return response(null, 200);
    }

    public function destroyAll()
    {
        Cart::truncate();
    }
}
