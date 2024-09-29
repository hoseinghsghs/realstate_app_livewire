<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\ElseIf_;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function index(){
         if(!Auth::user()){
        return redirect()->route('home');
        }
        elseif (Auth::user()->role_id===1) {
            return redirect()->route('admin.home');
        }
        elseif(Auth::user()->role_id===2)
        {
        return redirect()->route('agent.home');
        }
        elseif(Auth::user()->role_id===3)
        {
        return redirect()->route('user.home');
        }
       
    }
}