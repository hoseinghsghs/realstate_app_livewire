<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class SliderComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public Slider $slider;
    public $title;
    public $status = false;
    public $position;
    public $image;
    public $description;
    public $is_edit = false;
    public $display;
    public $initialized = false;


    public function ref()
    {
        $this->is_edit = false;
        $this->reset("title");
        $this->reset("slider");
        $this->reset("status");
        $this->reset("position");
        $this->reset("image");
        $this->reset("description");
        $this->reset("display");
        $this->reset("slider");
        $this->dispatch('resetfile');
        $this->resetValidation();
    }

    public function add_slider()
    {
        if ($this->is_edit) {
            // dd('sdf');

            $this->validate([
                'title'     => 'required|string|max:100',
                'image'     => 'nullable|image|mimes:jpeg,jpg,png',
                'position'      => 'required|string',
                'description'      => 'string',
                'status' => 'boolean'
            ]);
            $slug  = str_slug($this->title);

            if (isset($this->image)) {
                $currentDate = Carbon::now()->toDateString();

                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $this->image->extension();
                $filesystem = config('filesystems.default');

                $pach = config('filesystems.disks.' . $filesystem)['root'];

                if (!Storage::exists('slider')) {
                    Storage::makeDirectory('slider');
                }
                //delete image
                if (Storage::exists($this->slider->image)) {
                    Storage::delete($this->slider->image);
                }
                //resize & upload image
                $img = Image::make($this->image)->resize(1000, 667);

                if ($this->position == "اسلایدر") {
                    Image::make($this->image)->resize(2000, 1228)->save($pach . '/' . 'slider/' . $imagename);
                } elseif ($this->position == "بنر") {
                    Image::make($this->image)->resize(1200, 800)->save($pach . '/' . 'slider/' . $imagename);
                } elseif ($this->position == "تصویرسرویس") {
                    Image::make($this->image)->resize(1200, 800)->save($pach . '/' . 'slider/' . $imagename);
                }

                $img->save($pach . '/' . 'slider/' . $imagename);
                //save image path in db
            } else {
                $imagename = $this->slider->image;
            }


            $this->slider->update(
                [
                    "title" => $this->title,
                    "status" => $this->status,
                    "position" => $this->position,
                    "description" => $this->description,
                    "image" => $imagename,
                ]
            );

            $this->ref();
            flash()->success('تغییرات با موفقیت ذخیره شد');
        } else {

            $this->validate([
                'title'     => 'required|string|max:100|unique:sliders',
                'image'     => 'required|image|mimes:jpeg,jpg,png',
                'position'      => 'required|string',
                'description'      => 'string',
                'status' => 'boolean'
            ]);
            $slug  = str_slug($this->title);
            if (isset($this->image)) {
                // dd($this->image);
                $filesystem = config('filesystems.default');

                $pach = config('filesystems.disks.' . $filesystem)['root'];
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $this->image->extension();
                //make directory
                if (!Storage::exists('slider')) {
                    Storage::makeDirectory('slider');
                }
                //resize & upload image
                if ($this->position == "اسلایدر") {
                    $img = Image::make($this->image)->resize(2000, 1228);
                } elseif ($this->position == "بنر") {
                    $img = Image::make($this->image)->resize(1200, 800);
                } elseif ($this->position == "تصویرسرویس") {
                    $img = Image::make($this->image)->resize(1200, 800);
                }
                $img->save($pach . '/' . 'slider/' . $imagename);
            } else {
                $imagename = 'default.png';
            }
            $this->slider = Slider::create([
                "title" => $this->title,
                "status" => $this->status,
                "position" => $this->position,
                "description" => $this->description,
                "image" => $imagename,
            ]);
            $this->ref();
            flash()->success('اسلاید با موفقیت ذخیره شد');
        }
    }

    public function edit_slider(Slider $slider)
    {
        $this->slider = $slider;
        // $this->status = $slider->status;
        $this->is_edit = true;
        $this->title = $slider->title;
        $this->position = $slider->position;
        $this->description = $slider->description;
        // $this->image = $slider->image;
        $this->display = "disabled";
        if ($this->slider->status) {
            $this->status = true;
        } else {
            $this->status = false;
        };
    }
    public function destroy(Slider $slider)
    {
        if (Storage::exists('slider/' . $slider->image)) {
            Storage::delete('slider/' . $slider->image);
        }
        $slider->delete();

        flash()->success('اسلایدر با موفقیت حذف شد');
        return back();
    }
    public function render()
    {
        $sliders = Slider::latest()->paginate(10);
        return view('livewire.admin.slider.slider-component', compact('sliders'))->extends('livewire.admin-layout.layout.MasterAdmin')->section('Content');
    }
}
