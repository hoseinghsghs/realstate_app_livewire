<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\WishList;

class WishListController extends Controller
{
    public function add(Property $property)
    {
        if (auth()->check()) {

            $wishlist = WishList::where("user_id" ,'=', auth()->id())->where("property_id",'=', $property->id)->first();
           
            if ($wishlist) {
                Wishlist::where('property_id', $property->id)->where('user_id', auth()->id())->delete();
                return response(['errors' => 'deleted']);
            }else {
                Wishlist::create([
                    'user_id' => auth()->id(),
                    'property_id' => $property->id
                ]);
                return response(['errors' => 'saved']);
            }
             
        } else {
            return response(['errors' => 'sign']);
        }
    }

    public function show(){
        return view('home.pages.UserProfile.wish_list');
    }

    public function usersProfileIndex()
    {
        $wishlist = Wishlist::where('user_id' , auth()->id())->get();
        return view('home.users_profile.wishlist' , compact('wishlist'));
    }

}