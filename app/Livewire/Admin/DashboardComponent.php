<?php

namespace App\Livewire\Admin;

use App\Models\Agreement;
use App\Models\Comment;
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
        $m1 = Visit::where('date', '1')->where('years', $now)->get();
        $m2 = Visit::where('date', '2')->where('years', $now)->get();
        $m3 = Visit::where('date', '3')->where('years', $now)->get();
        $m4 = Visit::where('date', '4')->where('years', $now)->get();
        $m5 = Visit::where('date', '5')->where('years', $now)->get();
        $m6 = Visit::where('date', '6')->where('years', $now)->get();
        $m7 = Visit::where('date', '7')->where('years', $now)->get();
        $m8 = Visit::where('date', '8')->where('years', $now)->get();
        $m9 = Visit::where('date', '9')->where('years', $now)->get();
        $m10 = Visit::where('date', '10')->where('years', $now)->get();
        $m11 = Visit::where('date', '11')->where('years', $now)->get();
        $m12 = Visit::where('date', '12')->where('years', $now)->get();

        $visit = Visit::all();
        $propertycount = Property::count();
        $propertycount = Property::count();
        $commentcount  = Comment::count();
        $usercount     = User::count();
        $agreementcount = Agreement::count();
        $properties    = Property::latest()->with('user')->take(5)->get();
        $users         = User::with('role')->take(5)->get();
        // $comments      = Comment::with('users')->take(5)->get();
        //agent
        $propertycountAgent = Property::where('user_id', Auth::user()->id)->count();
        $comments      = Comment::with('user')->take(5)->get();
        return view('livewire.admin.dashboard-component', compact(
            'propertycount',
            'commentcount',
            'usercount',
            'agreementcount',
            'properties',
            'users',
            'comments',
            'propertycountAgent',
            'visit',
            'm1',
            'm2',
            'm3',
            'm4',
            'm5',
            'm6',
            'm7',
            'm8',
            'm9',
            'm10',
            'm11',
            'm12',
        ))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
