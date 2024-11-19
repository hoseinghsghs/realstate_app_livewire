<?php

namespace App\Livewire\Home\Pages;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class BlogComponent extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $posts = Post::with(['image', 'user'])->latest()->paginate(6);
        return view('livewire.home.pages.blog-component', compact('posts'))->extends('home.layout.HomeLayout')->section('content');
    }
}
