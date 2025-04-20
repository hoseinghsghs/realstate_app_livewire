<?php

namespace App\Livewire\Home\Pages\UserProfile;

use App\Models\WishList as ModelsWishList;
use Livewire\Component;

class WishList extends Component
{

    public function removeFromWishlist($propertyId)
    {
        if (auth()->check()) {
            ModelsWishList::where('property_id', $propertyId)->where('user_id', auth()->id())->delete();
            session()->flash('message', 'Property removed from wishlist.');
        } else {
            session()->flash('error', 'Please sign in to remove properties from your wishlist.');
        }
    }
    public function render()
    {
        $wishlist = ModelsWishList::where('user_id', auth()->id())->get();
        return view('livewire.home.pages.user-profile.wish-list', compact('wishlist'))->extends('livewire.home.layout.HomeLayout')->section('content');
    }
}


// if (auth()->check()) {

//     $wishlist = WishList::where("user_id" ,'=', auth()->id())->where("property_id",'=', $property->id)->first();
   
//     if ($wishlist) {
//         Wishlist::where('property_id', $property->id)->where('user_id', auth()->id())->delete();
//         return response(['errors' => 'deleted']);
//     }else {
//         Wishlist::create([
//             'user_id' => auth()->id(),
//             'property_id' => $property->id
//         ]);
//         return response(['errors' => 'saved']);
//     }
     
// } else {
//     return response(['errors' => 'sign']);
// }
