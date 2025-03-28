<?php

namespace App\Livewire\Home\Pages;

use App\Models\Post;
use Livewire\Component;

class ShowBlog extends Component
{
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $prev_post = Post::where('created_at', '>', $this->post->created_at)
            ->oldest() // Order by oldest first to get the closest newer post
            ->first();

        $next_post = Post::where('created_at', '<', $this->post->created_at)
            ->latest() // Order by newest first to get the closest older post
            ->first();
        return view('livewire.home.pages.show-blog', compact('prev_post', 'next_post'))
            ->extends('livewire.home.layout.HomeLayout')->section('content');
    }
}
