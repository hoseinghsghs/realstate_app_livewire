<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Property;
use App\Models\WishList;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
  
    public function boot()
    {
       
        view()->composer(['home.pages.UserProfile.index','test','home.partials.header','home.pages.UserProfile.wish_list','addcslashes','admin.partial.LeftSidebar'], function($view)
        {
            $view->with('property', Property::latest()->where('isactive', 1)->get())
           ->with('wishlist', Wishlist::where('user_id' , auth()->id())->get())->with('setting',Setting::firstOrNew());
          
        });
    }
}