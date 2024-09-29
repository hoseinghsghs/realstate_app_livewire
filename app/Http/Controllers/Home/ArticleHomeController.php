<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Verta;

class ArticleHomeController extends Controller
{
    public function index()
    {
       $articles= Article::with(['image','user'])->latest()->paginate(6);
        return view('home.pages.article',compact('articles'));
    }
    public function show(Article $article)
    {
        return view('home.pages.single-article',compact('article'));
    }
}