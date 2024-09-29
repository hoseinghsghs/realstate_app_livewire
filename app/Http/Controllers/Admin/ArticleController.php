<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Validation\Rule;
use Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.page.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ToastrFactory $flasher)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:100|unique:articles',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'body'      => 'required|string'
        ]);

        $slug  = str_slug($request->title);
        $data['user_id'] = auth()->id();
        $data['slug'] = $slug;
        $article = Article::create($data);

        // resize and save image
        $image = $request->file('image');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
            //make directory
            if (!Storage::exists('article')) {
                Storage::makeDirectory('article');
            }
            //resize & upload image
            $img = Image::make($image)->resize(1000, 667);
            $img->save(Storage::getAdapter()->getPathPrefix() . 'article/' . $imagename);
            //save image path on db
            $article->image()->create(['url' => "article/$imagename"]);
        }
        $flasher->addSuccess('مقاله با موفقیت ایجاد شد');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $image = $article->image;
        return view('admin.page.articles.edit', compact('article', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article, ToastrFactory $flasher)
    {
        $data = $request->validate([
            'title'     => ['required', 'string','max:100', Rule::unique('articles')->ignore($article->id)],
            'image'     => 'nullable|image|mimes:jpeg,jpg,png',
            'body'      => 'required|string'
        ]);
        $slug  = str_slug($request->title);
        $data['user_id'] = auth()->id();
        $data['slug'] = $slug;
        $article->update($data);
        // resize and save image
        $image = $request->file('image');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();

            if (!Storage::exists('article')) {
                Storage::makeDirectory('article');
            }
            //delete image
            if (Storage::exists($article->image->url)) {
                Storage::delete($article->image->url);
            }
            //resize & upload image
            $img = Image::make($image)->resize(1000, 667);
            $img->save(Storage::getAdapter()->getPathPrefix() . 'article/' . $imagename);
            //save image path in db
            $article->image()->update(['url' => "article/$imagename"]);
        }

        $flasher->addSuccess('مقاله با موفقیت بروزرسانی شد');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, ToastrFactory $flasher)
    {
        if (Storage::exists($article->image->url)) {
            Storage::delete($article->image->url);
        }
        $article->image()->delete();
        $article->delete();

        $flasher->addSuccess('مقاله با موفقیت حذف شد');
        return back();
    }
}