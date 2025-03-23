<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class ArticleComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public Article $article;
    public $title;
    public $user_id;
    public $status = false;
    public $body;
    public $image;
    public $description;
    public $is_edit = false;
    public $display;
    public $initialized = false;


    public function ref()
    {
        $this->is_edit = false;
        $this->reset("title");
        $this->reset("user_id");
        $this->reset("status");
        $this->reset("body");
        $this->reset("image");
        $this->reset("description");
        $this->reset("display");
        $this->reset("article");
        $this->dispatch('init-summernote');
        $this->dispatch('resetfile');
        $this->resetValidation();
    }

    public function add_article()
    {
        if ($this->is_edit) {
            // dd('sdf');

            $this->validate([
                'title'     => 'required|string|max:100',
                'image'     => 'nullable|image|mimes:jpeg,jpg,png',
                'body'      => 'required|string',
                'description'      => 'string',
                'status' => 'boolean'
            ]);
            $slug  = str_slug($this->title);

            $this->article->update(
                [
                    "title" => $this->title,
                    "user_id" => auth()->user()->id,
                    "status" => $this->status,
                    "body" => $this->body,
                    "description" => $this->description,
                    "slug" => $slug,
                ]
            );

            if (isset($this->image)) {
                $currentDate = Carbon::now()->toDateString();

                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $this->image->extension();
                $filesystem = config('filesystems.default');

                $pach = config('filesystems.disks.' . $filesystem)['root'];

                if (!Storage::exists('article')) {
                    Storage::makeDirectory('article');
                }
                //delete image
                if (Storage::exists($this->article->image->url)) {
                    Storage::delete($this->article->image->url);
                }
                //resize & upload image
                $img = Image::make($this->image)->resize(1000, 667);

                $img->save($pach . '/' . 'article/' . $imagename);
                //save image path in db
                $this->article->image()->update(['url' => "article/$imagename"]);
            }

            $this->ref();
            flash()->success('تغییرات با موفقیت ذخیره شد.');
        } else {

            $this->validate([
                'title'     => 'required|string|max:100|unique:articles',
                'image'     => 'required|image|mimes:jpeg,jpg,png',
                'body'      => 'required|string',
                'description'      => 'string',
                'status' => 'boolean'
            ]);
            $slug  = str_slug($this->title);
            $this->article = Article::create([
                "title" => $this->title,
                "user_id" => auth()->user()->id,
                "status" => $this->status,
                "body" => $this->body,
                "description" => $this->description,
                "slug" => $slug,
            ]);
            if (isset($this->image)) {
                // dd($this->image);
                $filesystem = config('filesystems.default');

                $pach = config('filesystems.disks.' . $filesystem)['root'];
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $this->image->extension();
                //make directory
                if (!Storage::exists('article')) {
                    Storage::makeDirectory('article');
                }
                //resize & upload image
                $img = Image::make($this->image)->resize(1000, 667);
                $img->save($pach . '/' . 'article/' . $imagename);
                //save image path on db
                $this->article->image()->create(['url' => "article/$imagename"]);
            }

            $this->ref();
            flash()->success('پست با موفقیت ایجاد شد');
        }
    }

    public function edit_article(Article $article)
    {
        $this->article = $article;
        // $this->status = $article->status;
        $this->is_edit = true;
        $this->title = $article->title;
        $this->body = $article->body;
        $this->description = $article->description;
        // $this->image = $article->image;
        $this->display = "disabled";
        if ($this->article->status) {
            $this->status = true;
        } else {
            $this->status = false;
        };
        $this->dispatch('init-summernote');
    }

    public function render()
    {
        $articles = Article::latest()->paginate(10);
        return view('livewire.admin.article.article-component', compact('articles'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
