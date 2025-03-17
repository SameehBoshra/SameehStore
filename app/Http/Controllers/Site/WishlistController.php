<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
use App\Models\User;


class WishlistController extends Controller
{
    public function index()
    {
        $products =  auth()->user()
            ->wishlist()
            ->latest()
            ->get();   // task for you basically we need to use pagination here
        return view('front.wishlists', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public function store()
    {

        if (! auth()->user()->wishlistHas(request('productId'))) {
            auth()->user()->wishlist()->attach(request('productId'));
        }
    }


    public function addToWishlist(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $productId = $request->productId;

    $wishlistItem = $user->wishlist()->where('product_id', $productId)->first();

    if ($wishlistItem) {
        $wishlistItem->delete();
        return response()->json(['wished' => false]);
    } else {
        $user->wishlist()->create(['product_id' => $productId]);
        return response()->json(['wished' => true]);
    }
}


public function destroy()
{
    auth()->user()->wishlist()->detach(request('product_id'));


}


}
