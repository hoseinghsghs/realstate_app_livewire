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
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public $email, $password, $remember, $deal_type, $property_type, $district;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->route('dashboard'); // تغییر مسیر به داشبورد
        } else {
            $this->addError('email', 'ایمیل یا رمز عبور اشتباه است.');
        }
    }

    public function searchProperty()
    {
        return $this->redirect(route('properties.list',
            ['deal_type' => $this->deal_type, "property_type" => $this->property_type, "district" => $this->district]),
            true);
    }

    public function render()
    {
        $sliders = Slider::all();
        $slider = $sliders->where('position', 'اسلایدر');

        $properties = Property::active()->latest()->get();
        $rent_properties = $properties->where('tr_type', 'رهن و اجاره')->take(6);
        $sell_properties = $properties->where('tr_type', 'فروش')->take(6);
        $apartment_properties_count = $properties->where('type', 'آپارتمان')->count();
        $villa_properties_count = $properties->where('type', 'خانه ویلایی')->count();
        $shop_properties_count = $properties->where('type', 'مغازه')->count();
        $land_properties_count = $properties->where('type', 'زمین و کلنگی')->count();

        $districts = $properties->unique('district')->pluck('district');
        $specials = $properties->where('lable', 'ویژه ها');

        $user_agent = User::where([['role_id', 2], ['isactive', 1]])->get();
        $wishlist = WishList::where('user_id', auth()->id())->get();
        $acount = User::where([['role_id', 2], ['isactive', 1]])->count();

        $ucount = User::count();
        $posts = Post::with('image')->latest()->take(3)->get();
        $articles = Article::with('image')->latest()->take(3)->get();

        return view('livewire.home.pages.home-component', compact(
            'user_agent',
            'slider',
            'rent_properties',
            'sell_properties',
            'wishlist',
            'districts',
            'apartment_properties_count',
            'villa_properties_count',
            'shop_properties_count',
            'land_properties_count',
            'acount',
            'ucount',
            'posts',
            'articles',
            'specials',
        ))->extends('livewire.home.layout.HomeLayout')->section('content');
    }
}
