<?php

namespace App\Livewire\Home\Pages;

use App\Models\Property;
use App\Models\WishList;
use Livewire\Component;

class ShowProperty extends Component
{
    public $property;

    public function mount(Property $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        // check if property active or not
        if (!$this->property->isactive) {
            abort(404);
        }

        $this->property->loadCount(['comments' => function ($query) {
            $query->where('approved', true);
        }])->load(['images', 'comments' => function ($query) {
            $query->where('approved', true);
        }, 'comments.user']);
        // get the property owner and count of it's properties
        $user = $this->property->user;
        $user->loadCount('properties');
        //similar properties
        $similar_properties =
            Property::active()->with('user')->latest()->where('tr_type', $this->property->tr_type)->take(5)->get()
                ->except([$this->property->id]);
        if (!auth()->check()) {
            $wishlist = false;
        } else {
            $wishlist =
                WishList::where("user_id", '=', auth()->id())->where("property_id", '=', $this->property->id)->first();
        }

        return view('livewire.home.pages.show-property',
            compact('similar_properties', 'user', 'wishlist'))->extends('livewire.home.layout.HomeLayout');
    }
}
