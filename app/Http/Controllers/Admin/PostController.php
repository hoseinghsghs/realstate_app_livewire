<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Validation\Rule;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.page.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.posts.create');
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
            'title'     => 'required|string|max:100|unique:posts',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'body'      => 'required|string'
        ]);

        $slug  = str_slug($request->title);
        $data['user_id'] = auth()->id();
        $data['slug'] = $slug;
        $post = Post::create($data);

        // resize and save image
        $image = $request->file('image');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
            //make directory
            if (!Storage::exists('post')) {
                Storage::makeDirectory('post');
            }
            //resize & upload image
            $img = Image::make($image)->resize(1000, 667);
            $img->save(Storage::getAdapter()->getPathPrefix() . 'post/' . $imagename);
            //save image path on db
            $post->image()->create(['url' => "post/$imagename"]);
        }
        $flasher->addSuccess('خبر با موفقیت ایجاد شد');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $image = $post->image;
        return view('admin.page.posts.edit', compact('post', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, ToastrFactory $flasher)
    {
        $data = $request->validate([
            'title'     => ['required', 'string','max:100', Rule::unique('posts')->ignore($post->id)],
            'image'     => 'nullable|image|mimes:jpeg,jpg,png',
            'body'      => 'required|string'
        ]);
        $slug  = str_slug($request->title);
        $data['user_id'] = auth()->id();
        $data['slug'] = $slug;
        $post->update($data);
        // resize and save image
        $image = $request->file('image');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();

            if (!Storage::exists('post')) {
                Storage::makeDirectory('post');
            }
            //delete image
            if (Storage::exists($post->image->url)) {
                Storage::delete($post->image->url);
            }
            //resize & upload image
            $img = Image::make($image)->resize(1000, 667);
            $img->save(Storage::getAdapter()->getPathPrefix() . 'post/' . $imagename);
            //save image path in db
            $post->image()->update(['url' => "post/$imagename"]);
        }

        $flasher->addSuccess('خبر با موفقیت بروزرسانی شد');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, ToastrFactory $flasher)
    {
        if (Storage::exists($post->image->url)) {
            Storage::delete($post->image->url);
        }
        $post->image()->delete();
        $post->delete();

        $flasher->addSuccess('خبر با موفقیت حذف شد');
        return back();
    }
}