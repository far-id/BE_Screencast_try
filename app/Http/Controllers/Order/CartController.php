<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\CartResource;
use App\Models\Order\Cart;
use App\Models\Screencast\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Playlist $playlist)
    {
        if (!Auth::user()->alreadyInCart($playlist)) {
            $cart = Auth::user()->addToCart($playlist);

            return response()->json([
                'status' => 'success',
                'message' => 'Added to cart',
                'data' => new CartResource($cart),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Playlist is already in cart'
        ]);
    }

    public function show()
    {
        return CartResource::collection(Auth::user()->carts()->latest()->get());
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Removed from cart',
        ]);
    }
}
