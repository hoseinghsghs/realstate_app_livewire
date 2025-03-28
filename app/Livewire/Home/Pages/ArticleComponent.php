<?php

namespace App\Livewire\Home\Pages;

use App\Models\Article;
use Livewire\Component;

class ArticleComponent extends Component
{
    public function render()
    {
        $articles = Article::with(['image', 'user'])->latest()->paginate(6);
        return view('livewire.home.pages.article-component', compact('articles'))
            ->extends('livewire.home.layout.HomeLayout')->section('content');
    }
}
