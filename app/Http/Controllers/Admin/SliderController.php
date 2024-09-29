<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Str;
use Image;




class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('admin.page.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ToastrFactory $flasher)
    {
        $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'position' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024',
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->title);


        if (isset($image)) {

            // گرفتن تاریخ
            $currentDate = Carbon::now()->toDateString();
            // نام عکس
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
            // آیا این پوشه وجود دارد
            if (!Storage::exists('slider')) {
                // این پوشه را بساز
                Storage::makeDirectory('slider');
            }
            if ($request->position=="اسلایدر") {
                $img = Image::make($image)->resize(2000, 1228);
                }
                elseif($request->position=="بنر"){
                $img = Image::make($image)->resize(1200, 800);
                }
                elseif($request->position=="تصویرسرویس"){
                $img = Image::make($image)->resize(1200, 800);
                }
            
            $img->save(Storage::getAdapter()->getPathPrefix() . 'slider/' . $imagename);
        } else {
            $imagename = 'default.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->position = $request->position;
        $slider->description = $request->description;
        $slider->image = $imagename;
        $slider->save();

        $flasher->addSuccess('اسلایدر با موفقیت ایجاد شد');
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {

        return view('admin.page.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider, ToastrFactory $flasher)
    {
      
        $request->validate([
            'title' => 'required|max:255',
            'position' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->extension();
            if (!Storage::exists('slider')) {
                Storage::makeDirectory('slider');
            }
            if (Storage::exists('slider/' . $slider->image)) {
                Storage::delete('slider/' . $slider->image);
            }
            if ($request->position == "اسلایدر") {
                Image::make($image)->resize(2000, 1228)->save(Storage::getAdapter()->getPathPrefix() . 'slider/' . $imagename);
            } elseif ($request->position == "بنر") {
                Image::make($image)->resize(1200, 800)->save(Storage::getAdapter()->getPathPrefix() . 'slider/' . $imagename);
            } elseif ($request->position == "تصویرسرویس") {
                Image::make($image)->resize(1200, 800)->save(Storage::getAdapter()->getPathPrefix() . 'slider/' . $imagename);
            }
        } else {
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->position = $request->position;
        $slider->description = $request->description;
        $slider->image = $imagename;
        $slider->save();

        $flasher->addSuccess('اسلایدر با موفقیت بروزرسانی شد');
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider, ToastrFactory $flasher)
    {
        if (Storage::exists('slider/' . $slider->image)) {
            Storage::delete('slider/' . $slider->image);
        }
        $slider->delete();

        $flasher->addSuccess('اسلایدر با موفقیت حذف شد');
        return back();
    }
}