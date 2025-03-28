<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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

        view()->composer(['livewire.home.pages.UserProfile.index', 'livewire.home.partials.header',
            'livewire.home.pages.UserProfile.wish_list', 'addcslashes', 'admin.partial.LeftSidebar'], function ($view) {
            $view->with('wishlist', Wishlist::where('user_id', auth()->id())->get());

        });

        $setting = Setting::firstOrNew();
        $setting['phones'] = json_decode($setting->phones);
        $setting['emails'] = json_decode($setting->emails);
        $setting['links'] = json_decode($setting->links);
        View::share('setting', $setting);
    }
}