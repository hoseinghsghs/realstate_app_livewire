<?php

namespace App\Livewire\Home\Pages;

use App\Models\Article;
use Livewire\Component;

class ShowArticle extends Component
{
    public $article;

    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function render()
    {
        return view('livewire.home.pages.show-article')->extends('livewire.home.layout.HomeLayout')->section('content');
    }
}
