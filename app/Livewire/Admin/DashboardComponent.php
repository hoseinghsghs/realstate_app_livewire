<?php

namespace App\Livewire\Admin;

use App\Models\Agreement;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Property;
use App\Models\User;
use App\Models\Visit;
use Livewire\Component;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;

class DashboardComponent extends Component
{

    public function render()
    {
        $v = verta();
        $now = $v->year;

        $property = Property::all();
        $year = $v->year; // سال مورد نظر را از درخواست دریافت کنید، در صورت عدم وجود، سال جاری را در نظر بگیرید
        $rent = $property->where("tr_type", "رهن و اجاره")->count();
        $sell = $property->where("tr_type", "فروش")->count();
        $presell = $property->where("tr_type", "پیش فروش")->count();

        $apr = $property->where("type", 'آپارتمان')->count();
        $vil = $property->where("type", 'خانه ویلایی')->count();
        $kol = $property->where("type", 'زمین و کلنگی')->count();
        $mag = $property->where("type", 'مغازه')->count();
        $kar = $property->where("type", 'دفتر کار')->count();
        $bag = $property->where("type", 'باغ')->count();
        $anb = $property->where("type", 'انبار')->count();

        $monthlyCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $from = verta()->year($year)->month($month)->startMonth()->toCarbon();
            $to = verta()->year($year)->month($month)->endMonth()->toCarbon();

            $count = Property::whereBetween('created_at', [$from, $to])->count();
            $monthlyCounts[$month] = $count;
        };

        $postcount = Post::count();
        $propertycount = Property::count();
        $commentcount  = Comment::count();
        $usercount     = User::count();
        $agreementcount = Agreement::count();
        $properties    = Property::latest()->with('user')->take(5)->get();
        $users         = User::with('role')->take(5)->get();
        // $comments      = Comment::with('users')->take(5)->get();
        //agent
        $propertycountAgent = $property->where('user_id', Auth::user()->id)->count();
        $comments      = Comment::with('user')->take(5)->get();
        return view('livewire.admin.dashboard-component', compact(
            'propertycount',
            'commentcount',
            'postcount',
            'usercount',
            'agreementcount',
            'properties',
            'users',
            'comments',
            'propertycountAgent',
            'monthlyCounts',
            'rent',
            'sell',
            'presell',
            'apr',
            'vil',
            'kol',
            'mag',
            'kar',
            'bag',
            'anb',

        ))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
