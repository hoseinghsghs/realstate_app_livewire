<?php

namespace App\Livewire\Home\Pages;

use App\Models\Article;
use App\Models\Post;
use App\Models\Property;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\Models\WishList;
use Livewire\Component;

class HomeComponent extends Component
{

    public function render()
    {
        $slider = Slider::where('position', 'اسلایدر')->get();
        $baner = Slider::where('position', 'بنر')->get();
        $service_image = Slider::where('position', 'تصویرسرویس')->get();
        $baner = Slider::where('position', 'بنر')->get();
        $property = Property::active()->latest();

        $property_rent = $property->where('tr_type', 'رهن و اجاره')->take(6)->get();
        $property_sell = $property->where('tr_type', 'فروش')->take(6)->get();


        $property_type_ap = $property->where('type', 'آپارتمان')->get();
        $property_sell_ho = $property->where('type', 'خانه ویلایی')->get();
        $property_sell_ma = $property->where('type', 'مغازه')->get();
        $property_sell_la = $property->where('type', 'زمین و کلنگی')->get();

        $service = Service::all();
        $user_agent = User::where([['role_id', 2], ['isactive', 1]])->get();
        $wishlist = WishList::where('user_id', auth()->id())->get();
        $districts = Property::all()->unique('district')->pluck('district');
        $acount = User::where([['role_id', 2], ['isactive', 1]])->count();
        $rcount = $property_rent->count();
        $scount = $property_sell->count();

        $apcount = $property_type_ap->count();
        $hocount = $property_sell_ho->count();
        $macount = $property_sell_ma->count();
        $lacount = $property_sell_la->count();

        $ucount = User::count();
        $specials = Property::latest()->where('lable', 'ویژه ها')->get();
        $posts = Post::with('image')->latest()->take(3)->get();
        $articles = Article::with('image')->latest()->take(3)->get();
        $setting = Setting::findOrNew(1);
        $setting->title = $setting->title;
        $setting->emails = json_decode($setting->emails, true);
        $setting->phones = json_decode($setting->phones, true);
        $setting->links = json_decode($setting->links, true) ?? [];

        return view('livewire.home.pages.home-component',  compact(
            'user_agent',
            'slider',
            'service',
            'baner',
            'service_image',
            'property_sell',
            'property_rent',
            'property',
            'wishlist',
            'districts',
            'rcount',
            'scount',
            'acount',
            'apcount',
            'hocount',
            'macount',
            'lacount',
            'ucount',
            'posts',
            'articles',
            'specials',
            'setting'
        ))->extends('home.layout.HomeLayout')->section('content');
    }
}
