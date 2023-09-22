<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WhishlistController extends Controller
{
    public function AddToWishList(Request $request, $property_id)
    {
        if (Auth::check()) {    // Check if  user  authenticated
            $exists = Whishlist::where('user_id', Auth::id())->where('property_id', $property_id)->first();
            if (!$exists) {
                Whishlist::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            } else {
                return response()->json(['error' => 'This Property Has Already in your WishList']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }

    public function UserWishlist()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.wishlist', compact('userData'));
    }


    public function GetWishlistProperty()
    {
        $wishlist = Whishlist::with('property')->where('user_id', Auth::id())->latest()->get();
        $wishQty = Whishlist::count();
        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }

    public function WishlistRemove($id)
    {
        Whishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Successfully Property Remove']);
    }
}
