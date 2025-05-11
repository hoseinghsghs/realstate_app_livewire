<?php

namespace App\Livewire\Admin\Post;

use App\Models\Post;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PostComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $numberOfPaginatorsRendered = [];

    protected $paginationTheme = 'bootstrap';
    public Post $post;
    public $title;
    public $user_id;
    public $status = false;
    public $body;
    public $image;
    public $description;
    public $is_edit = false;
    public $display;

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
        $this->reset("post");
        $this->dispatch('init-summernote');
        $this->dispatch('resetfile');
        $this->resetValidation();
    }

    public function add_post()
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

            $this->post->update(
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

                if (!Storage::exists('post')) {
                    Storage::makeDirectory('post');
                }
                //delete image
                if (Storage::exists($this->post->image->url)) {
                    Storage::delete($this->post->image->url);
                }
                //resize & upload image
                $img = Image::make($this->image)->resize(1000, 667);

                $img->save($pach . '/' . 'post/' . $imagename);
                //save image path in db
                $this->post->image()->update(['url' => "post/$imagename"]);
            }

            $this->ref();
            flash()->success('تغییرات با موفقیت ذخیره شد.');
        } else {

            $this->validate([
                'title'     => 'required|string|max:100|unique:posts',
                'image'     => 'required|image|mimes:jpeg,jpg,png',
                'body'      => 'required|string',
                'description'      => 'string',
                'status' => 'boolean'
            ]);
            $slug  = str_slug($this->title);
            $this->post = Post::create([
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
                if (!Storage::exists('post')) {
                    Storage::makeDirectory('post');
                }
                //resize & upload image
                $img = Image::make($this->image)->resize(1000, 667);
                $img->save($pach . '/' . 'post/' . $imagename);
                //save image path on db
                $this->post->image()->create(['url' => "post/$imagename"]);
            }

            $this->ref();
            flash()->success('پست با موفقیت ایجاد شد');
        }
    }

    public function edit_post(Post $post)
    {
        $this->post = $post;
        // $this->status = $post->status;
        $this->is_edit = true;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->description = $post->description;
        // $this->image = $post->image;
        $this->display = "disabled";
        if ($this->post->status) {
            $this->status = true;
        } else {
            $this->status = false;
        };
        $this->dispatch('init-summernote');
    }

    public function destroy(Post $post)
    {
        if (Storage::exists($post->image->url)) {
            Storage::delete($post->image->url);
        }
        $post->image()->delete();
        $post->delete();

        flash()->success('پست با موفقیت حذف شد');
        return back();
    }


    public function render()
    {
        $posts = Post::latest()->paginate(10);

        return view('livewire.admin.pages.post.post-component', compact('posts'))->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}
