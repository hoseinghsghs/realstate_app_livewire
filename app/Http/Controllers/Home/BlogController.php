<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Verta;

class BlogController extends Controller
{
    public function index()
    {
       $posts= Post::with(['image','user'])->latest()->paginate(6);
        return view('home.pages.blog',compact('posts'));
    }
    public function show(Post $post)
    {
        $posts=Post::latest()->get();
        $index=$posts->search($post);
        $prev_post=$posts->get($index-1);
        $next_post=$posts->get($index+1);
        return view('home.pages.single-blog',compact('post','prev_post','next_post'));
    }
}
